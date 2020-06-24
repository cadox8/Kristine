/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Database} from "../db/Database";
import {Website} from "../Website";
import {Lang} from "../lang/Lang";
import {ForumData} from "../forum/data/ForumData";
import {PostData} from "../forum/data/PostData";
import {Utils} from "../utils/Utils";
import {Permissions} from "../forum/ranks/Permissions";
import {Forum} from "../forum/Forum";

const router = Router();

router.get('/:id/:post', (req, res, next) => {
    if (Utils.installed()) {
        res.redirect('/install');
        return;
    }
    Database.hasConnection(connection => {
        if (connection) {
            res.render('errors/503');
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
    res.render('post', { title: 'Forum', help: { cat: forum.getCategory(forum.getForum(Number(req.params.id)).catId), for: forum.getForum(Number(req.params.id)).title }, post: forum.getPost(Number(req.params.id), Number(req.params.post)), data: data });
});

module.exports = router;