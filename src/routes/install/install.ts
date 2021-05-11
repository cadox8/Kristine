/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Config} from "../../forum/Config";
import {hashSync} from "bcryptjs";
import {writeFile} from "fs";
import {Log} from "../../utils/Log";
import {Database} from "../../database/Database";
import {createUser} from "../../database/schemas/user/User.db";
import {Defaults} from "../../utils/Defaults";

const router: Router = Router();

router.get('/', (req, res, next) => {
    res.render('install/install', { defaults: new Defaults() })
});

router.post('/', (req, res, next) => {
    const post: any = req.body;

    // mongo
    const hostname: string = post.hostname;
    const port: string = post.port;
    const database: string = post.database;
    const db_user: string = post.db_user;
    const db_password: string = post.db_password; // Cant hasSync this password

    // user
    const username: string = post.username;
    const email: string = post.email;
    const user_password: string = hashSync(post.user_password, 15);

    const defaultConfigFile: any = require('../../config/config.json');
    defaultConfigFile.mongodb = {
        "host": hostname,
        "port": port,
        "database": database,
        "user": db_user,
        "password": db_password
    }
    writeFile('./src/config/config.json', JSON.stringify(defaultConfigFile, null, 2), err => {
        if (err) {
            Log.error(err);
            res.render('install/install', { defaults: new Defaults(), err: 'The configuration file could not be saved. Please check that the folder has the correct permissions (666).' })
            return;
        }
        Log.info('Configuration file saved!');

        writeFile('./src/config/defaults.json', JSON.stringify({
            "port": 3856,
            "install": true
        }, null, 2), err => {
            if (err) {
                Log.error(err);
                res.render('install/install', { defaults: new Defaults(), err: 'The defaults file could not be saved. Please check that the folder has the correct permissions (666).' })
                return;
            }
            Log.info('Defaults file saved!');
        });

        new Database(new Config(require('../../config/config.json')).mongodb);
        setTimeout(() => {
            createUser(username, email, user_password, username, true).then(created => {
                if (created) {
                    res.render('install/success', { defaults: new Defaults() })
                    setTimeout(() => {
                        process.exit(0);
                    }, 1000)
                } else {
                    res.render('install/install', { defaults: new Defaults(), err: 'Could not connect with MongoDB. Please, check all fields and try again' })
                }
            });
        }, 1000);
    });
});

module.exports = router;