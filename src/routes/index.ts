/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {Router} from "express";
import {Forum} from "../forum/Forum";

const router: Router = Router();

router.get('/', (req, res, next) => {
    res.render('base')
});

export = router;