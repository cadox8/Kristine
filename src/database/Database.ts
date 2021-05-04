/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {createPool, Pool, Query, queryCallback, QueryOptions} from "mysql";
import {Log} from "../utils/Log";
import {Config} from "../forum/Config";

export class Database {

    private static pool: Pool;

    constructor(config: Config) {
        Database.pool = createPool({
            host: config.mysql.host,
            port: config.mysql.port,
            database: config.mysql.database,
            user: config.mysql.user,
            password: config.mysql.password,
            multipleStatements: true
        });

        Database.pool.getConnection((err, connection) => {
            if (err) {
                Log.error('Not connected to database!');
            } else {
                Log.info('Connected to database!')
            }
        });
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