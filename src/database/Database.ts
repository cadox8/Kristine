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

    public readonly uri: string;

    constructor(mongodb: { host: string, port: string, database: string, user: string, password: string }) {
        this.uri = `mongodb://${mongodb.user}:${encodeURI(mongodb.password)}@${mongodb.host}:${mongodb.port}/${mongodb.database}`;
        connect(this.uri, {
            useNewUrlParser: true,
            useFindAndModify: true,
            useUnifiedTopology: true,
            useCreateIndex: true,
            poolSize: 10,
            connectTimeoutMS: 3000
        }).then(() => {
            Log.info('Connected to Database');
        }).catch(err => {
            Log.error('Error connecting to Database');
            Log.error(err.message);
        });
    }

    public close(): void {
        if (connection) disconnect();
    }
}