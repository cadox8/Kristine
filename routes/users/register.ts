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
    const data = {
        siteName: Website.config.siteName,
        lang: new Lang(Website.config.lang),
        errorCode: -1,
        errorMsg: ''
    }
    res.render('users/register', { title: 'Index', data: data });
});

router.post('/', (req, res, next) => {
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
    const data = {
        siteName: Website.config.siteName,
        lang: new Lang(Website.config.lang),
        errorCode: -1,
        errorMsg: ''
    }

    const post = req.body;
    const username = Database.escape(post.username);
    const email = Database.escape(post.email);
    const pass = Database.escape(post.password);
    const pass2 = Database.escape(post.password2);
    const hash = hashSync(pass, 10);
    const birth = post.birth;

    if (pass !== pass2) {
        data.errorCode = 2
        data.errorMsg = 'Password does not match'
        res.render('users/register', { title: 'Index', data: data });
        return;
    }

    // ToDo: Check for Username/Email
    // ToDo: Save user in DB and redirect to to index/confirmation page
});

module.exports = router;