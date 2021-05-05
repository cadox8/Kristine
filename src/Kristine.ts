/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {Application} from "express";
import express from 'express';
import {createServer, Server} from "http";
import path from "path";
import {urlencoded} from "body-parser";
import session from "express-session";
import {Log} from "./utils/Log";
import {Forum} from "./forum/Forum";
import {installMiddleware} from "./middlewares/InstallMiddleware";

export class Kristine {

    private readonly defaults: any = require('./config/defaults.json');

    private readonly forum: Forum;

    private readonly app: Application;
    private readonly server: Server;

    constructor() {
        this.app = express();


        // Forum load
        this.forum = new Forum();


        // App load
        this.app.set('views', path.join(__dirname, '../src/front/views'));
        this.app.set('view engine', 'pug');
        this.app.set('view options', { pretty: true });
        this.app.locals.pretty = true;

        this.app.use(express.json());
        this.app.use(urlencoded({ extended: true }));

        this.app.use(installMiddleware); // Check installation

        this.app.use('/', express.static(path.join(__dirname, '../src/front/public'), { maxAge: 86400000, immutable: true, dotfiles: 'allow' } ));

        this.app.use(session({
            cookie: {
                path: '/',
                maxAge: 1000 * 60 * 60 * 24 * 30,
                //secure: true
            },
            secret: 'absorb-grant-remain',
            name: 'Kristine',
            resave: false,
            saveUninitialized: false,
        }));

        this.app.use((req, res, next) => {
            res.locals.session = req.session;
            next();
        });

        this.server = createServer(this.app).listen(this.defaults.port);
        this.server.on('listening', () => Log.debug('Server started on port ' + this.defaults.port));
        this.server.on('error', err => Log.error(`${err.name}\n${err.message}\n${err.stack}`));

        // Routes
        this.registerRoutes();
    }

    private registerRoutes(): void {
        this.route('', 'index');
    }

    private route(route: string, path: string): void {
        this.app.use('/' + route, require('./routes/' + path));
    }
}

const kristine: Kristine = new Kristine();