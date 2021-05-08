/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Router} from "express";
import {Config} from "../../forum/Config";

const router: Router = Router();

router.get('/', (req, res, next) => {
    res.render('install/install', { title: Config.SITE_NAME()})
});

router.post('/', (req, res, next) => {

});


router.get('/config', (req, res, next) => {

});

router.post('/config', (req, res, next) => {

});

module.exports = router;