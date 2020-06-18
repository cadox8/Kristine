/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Config} from "../utils/Config";
import {createPool, Pool, Query, queryCallback, QueryOptions} from "mysql";
import {Log} from "../utils/Log";

export class Database {

    private readonly config: Config;

    private static pool: Pool;

    constructor(config: Config) {
        this.config = config;

        Database.pool = createPool({
            host: config.mysql.host,
            port: config.mysql.port,
            user: config.mysql.user,
            password: config.mysql.password,
            database: config.mysql.db,
            multipleStatements: true
        });

        Database.pool.on('error', err => Log.error(err.sqlMessage, 'Database'));
        Database.pool.on('connection', connection => Log.success('Connected to Database', 'Database'));
    }

    public static query(options: string | QueryOptions, callback?: queryCallback): Query {
        return this.pool.query(options, callback);
    }

    public static escape(value: string): string {
        return Database.pool.escape(value);
    }

    public static hasConnection(callback: (connection: boolean) => void): void {
        Database.pool.getConnection(err => callback(err !== null));
    }
}