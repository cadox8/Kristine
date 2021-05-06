/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {connect, disconnect, connection} from "mongoose";
import {Log} from "../utils/Log";
import {Config} from "../forum/Config";

export class Database {

    constructor(config: Config) {
        connect(config.uri, {
            useNewUrlParser: true,
            useFindAndModify: true,
            useUnifiedTopology: true,
            useCreateIndex: true
        }).then(() => {
            Log.info('Connected to Database');
        }).catch(err => {
            Log.error('Error connecting to Database');
            Log.error(err);
        });
    }

    public close(): void {
        if (connection) disconnect();
    }
}