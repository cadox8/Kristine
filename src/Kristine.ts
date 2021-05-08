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
import MongoStore from "connect-mongo";
import compression from "compression";

export class Kristine {

    private readonly defaults: any = require('./config/defaults.json');

    private readonly forum: Forum;

    private readonly app: Application;
    private readonly server: Server;

    constructor() {
        this.app = express();

        // Forum load
        if (require('./config/defaults.json').install) this.forum = new Forum();

        // App load
        this.app.set('views', path.join(__dirname, 'front/views'));
        this.app.set('view engine', 'pug');
        this.app.set('view options', { pretty: true });
        this.app.enable('view cache');
        this.app.locals.pretty = true;
        this.app.locals.compileDebug = false;

        this.app.use(compression())
        this.app.use(express.json());
        this.app.use(urlencoded({ extended: true }));

        this.app.use('/', express.static(path.join(__dirname, 'front/public'), { maxAge: 86400000, immutable: true, dotfiles: 'allow' } ));

        if (require('./config/defaults.json').install) {
            this.app.use(session({
                cookie: {
                    path: '/',
                    maxAge: 1000 * 60 * 60 * 24 * 30,
                    //secure: true
                },
                store: MongoStore.create({
                    mongoUrl: this.forum.database.uri,
                    collectionName: 'sessions',
                    touchAfter: 24 * 3600,
                    mongoOptions: {
                        useUnifiedTopology: true
                    },
                    crypto: {
                        secret: 'ideology-rebellion-ghost'
                    }
                }),
                secret: 'thick-performer-node',
                name: 'Kristine',
                resave: false,
                saveUninitialized: false,
            }));
        }

        this.app.use((req, res, next) => {
            res.locals.session = req.session;
            next();
        });

        // Middlewares
        this.app.use(((req, res, next) => {
            const path: boolean = req.path.includes('install');
            if (require('./config/defaults.json').install) {
                if (path) {
                    res.redirect('/')
                } else {
                    next()
                }
            } else {
                if (!path) {
                    res.render('install', { title: 'Kristine' })
                } else {
                    next()
                }
            }
        }))

        this.server = createServer(this.app).listen(this.defaults.port);
        this.server.on('listening', () => Log.debug('Server started on http://localhost:' + this.defaults.port));
        this.server.on('error', err => Log.error(`${err.name}\n${err.message}\n${err.stack}`));

        // Routes
        this.registerRoutes();
    }

    private registerRoutes(): void {
        this.route('', 'index');

        // Install Script
        this.route('install', 'install/install');
    }

    private route(route: string, path: string): void {
        this.app.use('/' + route, require('./routes/' + path));
    }
}

const kristine: Kristine = new Kristine();