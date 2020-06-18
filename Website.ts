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

export class Website {

    public static config: Config;
    private readonly database: Database;
    private readonly server: ServerLoader;
    private routes: Routes;

    constructor() {
        Website.config = new Config();
        this.database = new Database(Website.config);
        this.server = new ServerLoader(Website.config);

        this.loadRanks();

        this.load();
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

    private loadRanks() {
        Database.query("SELECT * FROM `ranks`", (err, result) => {
            if (err) { // Load default ranks
                defaultRanks().forEach(r => Website.config.addRank(r));
                return;
            }
            const ranks = JSON.parse(JSON.stringify(result));
            ranks.forEach(r => {
                const rank: Rank = new Rank(r.id);
                rank.name = r.name;
                rank.permissions = r.permissions;
                rank.rank = r.rank;
                Website.config.addRank(rank);
            })
        })
    }
}

// Load Website
const website: Website = new Website();