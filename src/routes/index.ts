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
import {getAllCategories} from "../database/schemas/forum/Category.db";
import {getAllForums} from "../database/schemas/forum/Forum.db";
import {Defaults} from "../utils/Defaults";

const router: Router = Router();

router.get('/', (req, res, next) => {
    getAllCategories().then(categories => {
        getAllForums().then(forums => {
            res.render('base', { defaults: new Defaults(), cats: categories, forums: forums });
        })
    });
});

export = router;