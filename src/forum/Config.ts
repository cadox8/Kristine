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

    public readonly uri: string;

    public maintenance: {
        message: string
    }

    constructor() {
        const configFile: any = require('../config/config.json');

        this.siteName = configFile.siteName;
        this.themeColor = configFile.themeColor;
        this.uri = configFile.uri;

        this.maintenance = configFile.maintenance
    }

    public saveConfig(): void {
        writeFile('../config/config.json', JSON.stringify(this), 'utf8', err => {
           if (err) {
               Log.error('Config file could not be saved!')
               return
           }
           Log.info('Config file saved!')
        });
    }

    public loadConfig(): Config {
        return new Config();
    }

    // Lets make this static just to load in .pug
    public static SITE_NAME(): String {
        return Forum.instance.config.siteName;
    }

    public static THEME_COLOR(): String {
        return Forum.instance.config.themeColor;
    }
}