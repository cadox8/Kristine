/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

export class Config {

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
}