/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {writeFile} from "fs";
import {Log} from "../utils/Log";
import {Forum} from "./Forum";

export class Config {

    public siteName: string;
    public themeColor: string;

    public readonly mongodb: {
        host: string,
        port: string,
        database: string,
        user: string,
        password: string
    }

    public maintenance: {
        message: string
    }

    constructor(configFile: any) {
        this.siteName = configFile.siteName;
        this.themeColor = configFile.themeColor;
        this.mongodb = configFile.mongodb;

        this.maintenance = configFile.maintenance
    }

    public saveThisConfig(): void {
        this.saveConfig(this);
    }
    public saveConfig(config: Config): void {
        writeFile('../config/config.json', JSON.stringify(config), 'utf8', err => {
           if (err) {
               Log.error('Config file could not be saved!')
               return
           }
           Log.info('Config file saved!')
        });
    }

    public loadConfig(): Config {
        return new Config(require('../config/config.json'));
    }

    // Lets make this static just to load in .pug
    public static SITE_NAME(): String {
        return Forum.instance.config.siteName;
    }

    public static THEME_COLOR(): String {
        return Forum.instance.config.themeColor;
    }
}