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
import {Category} from "../forum/data/Category";
import {Website} from "../Website";
import {Lang} from "../lang/Lang";
import {ForumData} from "../forum/data/ForumData";
import {PostData} from "../forum/data/PostData";
import {Author} from "../forum/data/Author";
import {Utils} from "../utils/Utils";
import {Permissions} from "../forum/ranks/Permissions";
import {Forum} from "../forum/Forum";

const router = Router();

router.get('/', (req, res, next) => {
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
    res.render('index', { title: 'Index', content: forum.categories, data: data });
});

module.exports = router;