/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import { Request, Response, NextFunction } from 'express';

export const installMiddleware = (req: Request, res: Response, next: NextFunction) => {
    if (req.path.includes('install')){
        next();
    } else {
        require('../config/defaults.json').install ? next() : res.redirect('/install');
    }
};