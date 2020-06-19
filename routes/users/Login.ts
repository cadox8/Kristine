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
import {compareSync} from "bcryptjs";
import {Database} from "../../db/Database";
import {Forum} from "../../forum/Forum";
import {Utils} from "../../utils/Utils";

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
    res.render('users/login', { title: 'Login', data: data });
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
    const login = Database.escape(post.login);
    const pass = Database.escape(post.password);
    let query: string;

    if (login.includes('@')) {
        query = "`email`=" + login;
    } else {
        query = "`username`=" + login;
    }

    Database.query("SELECT `id`, `username`, `email`, `name`, `hash`, `rank`, `icon`, `name`, `lang` FROM `users` WHERE " + query, ((err, result) => {
        if (err) {
            data.errorCode = 1
            data.errorMsg = 'This username/email does not exists on the site'
            res.render('users/login', { title: 'Login', data: data });
            return;
        }
        if (compareSync(pass, result[0].hash)) {
            req.session.user = result[0].id;
            req.session.username = result[0].username;
            req.session.email = result[0].email;
            req.session.rank = result[0].rank;
            req.session.icon = result[0].icon;
            req.session.name = result[0].name;
            req.session.lang = result[0].lang;
            res.redirect('/');
        } else {
            data.errorCode = 2;
            data.errorMsg = 'Wrong username/email/password';
            res.render('users/login', { title: 'Login', data: data });
            return;
        }
    }));
});

module.exports = router;