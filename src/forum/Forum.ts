/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {Config} from "./Config";
import {Database} from "../database/Database";

export class Forum {

    public static instance: Forum;

    public readonly config: Config;
    public readonly database: Database;

    constructor() {
        Forum.instance = this;
        this.config = new Config(require('../config/config.json'));
        this.database = new Database(this.config.mongodb);
    }
}