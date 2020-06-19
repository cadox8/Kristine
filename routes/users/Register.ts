/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Website} from "../../Website";
import {Lang} from "../../lang/Lang";
import {hashSync} from "bcryptjs";
import {Database} from "../../db/Database";
import {Utils} from "../../utils/Utils";
import {Forum} from "../../forum/Forum";

const router = Router();

router.get('/', (req, res, next) => {
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503');
            return;
        }
    });
    if (req.session.name != null) {
        res.redirect('/');
        return;
    }
    const forum: Forum = Forum.instance;

    const lang = req.session.name == null ? forum.config.lang : req.session.lang;
    const data = {
        siteName: forum.config.siteName,
        lang: new Lang(lang),
        utils: new Utils(),
        errorCode: -1,
        errorMsg: ''
    }
    res.render('users/register', { title: 'Register', data: data });
});

router.post('/', (req, res) => {
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503');
            return;
        }
    });
    if (req.session.name != null) {
        res.redirect('/');
        return;
    }
    const forum: Forum = Forum.instance;

    const lang = req.session.name == null ? forum.config.lang : req.session.lang;
    const data = {
        siteName: forum.config.siteName,
        lang: new Lang(lang),
        utils: new Utils(),
        errorCode: -1,
        errorMsg: ''
    }

    const post = req.body;
    const username = Database.escape(post.username);
    const email = Database.escape(post.email);
    const pass = Database.escape(post.password);
    const pass2 = Database.escape(post.password2);
    const hash = hashSync(pass, 10);

    if (pass !== pass2) {
        data.errorCode = 2
        data.errorMsg = 'Password does not match'
        res.render('users/register', { title: 'Register', data: data });
        return;
    }

    Database.query("SELECT COUNT(*) AS users FROM `users` WHERE `username`=" + username + "", (error, result) => {
        Database.query("SELECT COUNT(*) AS emails FROM `users` WHERE `email`=" + email + "", (error2, result2) => {
            if (error || error2 || result[0].users > 0 || result2[0].emails > 0) {
                data.errorCode = 1
                data.errorMsg = 'This username/email already exists on the site'
                res.render('users/register', { title: 'Register', data: data });
                return;
            }
            Database.query("INSERT INTO `users`(`username`, `name`, `email`, `hash`) VALUES (" + username + ", " + username + ", " + email + ", '" + hash + "')", ((err, result) => {
                if (err) {
                    data.errorCode = 3
                    data.errorMsg = 'There was an error while creating your account. Please, contact with a site administrator'
                    res.render('users/register', { title: 'Register', data: data });
                    return;
                }
            }));
            Database.query("SELECT `rank`, `icon`, `name`, `lang` FROM `users` WHERE `email`=" + email, ((err, result) => {
                req.session.username = username;
                req.session.email = email;
                req.session.rank = result[0].rank;
                req.session.icon = result[0].icon;
                req.session.name = result[0].name;
                req.session.lang = result[0].lang;
                res.redirect('/');
            }))
        });
    });
});

module.exports = router;