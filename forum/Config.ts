/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Rank} from "./ranks/Rank";

export class Config {

    private readonly _ranks: Rank[] = []

    //
    private readonly config = require('../config.json');
    //


    public readonly siteName: string = this.config.siteName;

    public readonly lang: string = this.config.lang;

    public readonly ssl: boolean = this.config.ssl;
    public readonly options = this.config.options;

    public readonly ports = this.config.ports;
    public readonly mysql = this.config.mysql;

    public readonly debug = this.config.debug;


    public addRank(rank: Rank): void {
        this._ranks.push(rank);
    }

    public removeRank(rank: Rank): void {
        this._ranks.splice(this._ranks.indexOf(this.getRank(rank.id)), 1);
    }

    public getRank(id: number): Rank {
        return this._ranks.find(r => r.id == id);
    }

    public hasRank(rank: Rank): boolean {
        return this._ranks.includes(rank);
    }
}