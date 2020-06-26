/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {ServerLoader} from "./server/ServerLoader";
import {Routes} from './server/Routes';
import {Config} from "./forum/Config";
import {Database} from "./db/Database";
import {defaultRanks, Rank} from "./forum/ranks/Rank";
import {Forum} from "./forum/Forum";
import {Log} from "./utils/Log";
import {Updater} from "./utils/Updater";
import {Lang} from "./lang/Lang";
import {Utils} from "./utils/Utils";

export class Website {

    public static readonly VERSION_DATA = 4
    public static readonly VERSION = 'v0.1.0 - Alpha'

    private readonly update: Updater;

    private readonly forum: Forum;

    private readonly database: Database;
    private readonly server: ServerLoader;
    private routes: Routes;

    constructor() {
        this.update = new Updater();
        Log.spacer(0);
        Log.success('Loading Forum...');

        this.forum = new Forum();
        this.database = new Database(this.forum.config);
        this.server = new ServerLoader(this.forum.config);

        this.forum.loader();
        this.load();

        if (!this.forum.config.installed) Log.warning('The forum is not installed. Will run the install script.', 'Installation');

        Log.success('Forum Loaded!');
        Log.spacer(-1);
        Log.success('Kristine Forum ' + Website.VERSION)
        this.update.timeToUpdate()
        Log.spacer(1);
    }

    private load() {
        this.routes = new Routes(this.server.app);
        this.routes.loadURLs();

        this.server.app.use((req, res, next) => {
            res.render('errors/404', { title: '404', data: {
                    siteName: this.forum.config.siteName,
                    lang: new Lang(this.forum.config.lang),
                    utils: new Utils()
                } });
        });
        this.server.app.use((err: { message: any; status: any; }, req: any, res, next: any) => {
            res.locals.message = err.message;

            res.status(err.status || 500);
            res.render('errors/503', { title: '404', data: {  siteName: this.forum.config.siteName } });
            console.log(err);
        });
    }
}

// Load Website
const website: Website = new Website();