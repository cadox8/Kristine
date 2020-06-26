/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Database} from "../../db/Database";
import {Forum} from "../../forum/Forum";
import {Utils} from "../../utils/Utils";
import {Lang} from "../../lang/Lang";
import {Config} from "../../forum/Config";

const router = Router();

router.get('/', (req, res, next) => {
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503', { title: '503', data: {  siteName: Forum.instance.config.siteName } });
            return;
        }
    });

    const forum: Forum = Forum.instance;
    const lang = req.session.user == null ? forum.config.lang : req.session.user.lang;
    const data = {
        siteName: forum.config.siteName,
        lang: new Lang(lang),
        utils: new Utils(),
        config: forum.config
    }
    res.render('install/install', { title: 'Install', data: data });
});

router.post('/', (req, res, next) => {
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503', { title: '503', data: {  siteName: Forum.instance.config.siteName } });
            return;
        }
    });
    const config: Config = Forum.instance.config;
    const post = req.body;

    const sitename: string = post.sitename;
    const lang = post.lang;

    const host: string = post.host;
    const db: string = post.db;
    const port: number = Number(post.port);
    const user: string = post.user;
    const password: string = post.password;

    const key: string = post.key;
    const cert: string = post.cert;
    const ca: string = post.ca;

    const data: string = post.data;
    const database: string = post.database;

    config.siteName = sitename;
    config.lang = lang;

    config.mysql.host = host;
    config.mysql.db = db;
    config.mysql.port = port;
    config.mysql.user = user;
    config.mysql.password = password;

    if (key && cert && ca) {
        config.ssl = true;
        config.options.cert = cert;
        config.options.ca = ca;
        config.options.key = key;
    }

    config.debug.database = database === 'on';
    config.debug.data = data === 'on';

    config.installed = true;
    config.save();
    res.redirect('/');
});

module.exports = router;