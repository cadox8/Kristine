/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Lang} from "../../lang/Lang";
import {Utils} from "../../utils/Utils";
import {Forum} from "../../forum/Forum";

const router = Router();

router.get('/', (req, res, next) => {
    const forum: Forum = Forum.instance;
    const lang = req.session.user == null ? forum.config.lang : req.session.user.lang;
    const data = {
        siteName: forum.config.siteName,
        lang: new Lang(lang),
        utils: new Utils()
    }
    res.render('utils/tos', { title: 'Terms of Service', data: data });
});

module.exports = router;