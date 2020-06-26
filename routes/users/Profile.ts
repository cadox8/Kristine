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
import {Lang} from "../../lang/Lang";
import {Utils} from "../../utils/Utils";
import {Permissions} from "../../forum/ranks/Permissions";

const router = Router();

router.get('/:user', (req, res, next) => {
    if (Utils.installed()) {
        res.redirect('/install');
        return;
    }
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
        permissions: Permissions
    }

    Database.query("SELECT * FROM `users` WHERE `id`='" + req.params.user + "'", (err, result) => {
       if (err) {
           res.redirect('/');
           return;
       }
       res.render('users/profile', { title: 'Profile', data: data, user: JSON.parse(JSON.stringify(result))[0] });
    });
});

module.exports = router;