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

export class Website {

    public static readonly VERSION_DATA = 3
    public static readonly VERSION = 'v0.0.4 - Alpha'

    private readonly forum: Forum;

    private readonly database: Database;
    private readonly server: ServerLoader;
    private routes: Routes;

    constructor() {
        Log.spacer(0);
        Log.success('Loading Forum...');

        this.forum = new Forum();
        this.database = new Database(this.forum.config);
        this.server = new ServerLoader(this.forum.config);

        this.forum.loader();
        this.load();

        Log.success('Forum Loaded!');
        Log.spacer(-1);
        Log.success('Kristine Forum ' + Website.VERSION)
        if (new Updater().timeToUpdate()) {
            Log.warning('Hey! Seems that you have an older version of Kristine', 'Update');
            Log.warning('You can update the forum from the Admin Section', 'Update');
            Log.warning('Or download the latest version from https://github.com/cadox8/Kristine/releases', 'Update')
        }
        Log.spacer(1)
    }

    private load() {
        this.routes = new Routes(this.server.app);
        this.routes.loadURLs();

        this.server.app.use((req, res, next) => {
            res.render('errors/404');
        });
        this.server.app.use((err: { message: any; status: any; }, req: any, res: { locals: { message: any; }; status: (arg0: any) => void; render: (arg0: string) => void; }, next: any) => {
            res.locals.message = err.message;

            res.status(err.status || 500);
            res.render('errors/503');
            console.log(err);
        });
    }
}

// Load Website
const website: Website = new Website();