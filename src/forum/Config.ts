/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

export class Config {

    public siteName: string;
    public themeColor: number;

    public readonly mysql: {
        host: string,
        port: number,
        database: string,
        user: string,
        password: string
    };

    constructor() {
        const configFile: any = require('../config/config.json');

        this.siteName = configFile.siteName;
        this.themeColor = configFile.themeColor;
        this.mysql = configFile.mysql;
    }
}