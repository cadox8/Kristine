/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import express, {Application} from 'express';
import https from 'https';
import http from 'http';
import {Server} from "net";
import cookieParser from "cookie-parser";
import session from "express-session";
import {Log} from "../utils/Log";
import {Config} from "../forum/Config";
import bodyParser from "body-parser";

export class ServerLoader {

    private readonly _app: Application;

    private _server: Server;
    private _secureServer: Server;

    private readonly config: Config;

    private readonly options = {};

    constructor(config: Config) {
        this._app = express();
        this.config = config;

        this.loadApp();
        this.loadServer();

        if (this.config.ssl) this.options = this.config.options;
    }

    private loadApp() {
        this._app.set('views', './views');
        this._app.set('view engine', 'pug');
        this._app.set('view options', { pretty: true });
        this._app.set('trust proxy', 1);

        this._app.use(cookieParser());
        this._app.use(session({
            cookie: {
                path: '/',
                maxAge: 600000000,
                secure: this.config.ssl,
                sameSite: true
            },
            secret: '1e8b3c8910aa9906',
            name: 'Kristine',
            saveUninitialized: true,
            resave: true
        }));

        this._app.use(express.json());
        this._app.use(bodyParser.urlencoded({ extended:true }));

        this._app.use(express.static('./public', { maxAge: 86400000, immutable: true, dotfiles: 'allow' } ));
        this._app.use(express.static('./', { maxAge: 86400000, immutable: true, dotfiles: 'allow' } ));

        this._app.use(function(req,res,next){
            res.locals.session = req.session;
            next();
        });

        if (this.config.ssl) {
            this._app.use(function(req, res, next) {
                if (req.secure) {
                    next();
                } else {
                    res.redirect('https://' + req.headers.host + req.url);
                }
            });
        }
    }

    private loadServer() {
        if (this.config.ssl) {
            this._secureServer = https.createServer(this.options, this._app).listen(this.config.ports.secure);
            this._secureServer.on('error', (error) => { throw error; });
            this._secureServer.on('listening', () => Log.success('Secure Server Started (' + this.config.ports.secure + ')', 'Server'));
        }

        this._server = http.createServer(this._app).listen(this.config.ports.insecure);
        this._server.on('error', (error) => { throw error; });
        this._server.on('listening', () => Log.success('Insecure Server Started (' + this.config.ports.insecure + ')', 'Server'));
    }

    get app(): Application {
        return this._app;
    }

    get server(): Server {
        return this._server;
    }

    get secureServer(): Server {
        return this._secureServer;
    }
}