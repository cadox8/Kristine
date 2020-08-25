/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {writeFile} from "fs";
import {Log} from "../utils/Log";

export class Config {

    //
    private readonly path = '../config.json';
    private config = require(this.path);
    //

    private _siteName: string = this.config.siteName;

    private _lang: string = this.config.lang;

    private _ssl: boolean = this.config.ssl;
    private _options = this.config.options;

    private _ports = this.config.ports;
    private _mysql = this.config.mysql;
    private _email = this.config.email;

    private _update: number = this.config.update;

    private _installed: boolean = this.config.installed;

    private _debug = this.config.debug;


    get siteName(): string {
        return this._siteName;
    }

    set siteName(value: string) {
        this._siteName = value;
    }

    get lang(): string {
        return this._lang;
    }

    set lang(value: string) {
        this._lang = value;
    }

    get ssl(): boolean {
        return this._ssl;
    }

    set ssl(value: boolean) {
        this._ssl = value;
    }

    get options(): { key: string, cert: string, ca: string } {
        return this._options;
    }

    set options(value: { key: string, cert: string, ca: string }) {
        this._options = value;
    }

    get ports(): { insecure: number, secure: number } {
        return this._ports;
    }

    set ports(value: { insecure: number, secure: number }) {
        this._ports = value;
    }

    get mysql(): { host: string, port: number, db: string, user: string, password: string } {
        return this._mysql;
    }

    set mysql(value: { host: string, port: number, db: string, user: string, password: string }) {
        this._mysql = value;
    }

    get email(): { from: string, host: string, port: number, user: string, password: string } {
        return this._email;
    }

    set email(value: { from: string, host: string, port: number, user: string, password: string }) {
        this._email = value;
    }

    get update(): number {
        return this._update;
    }

    set update(value: number) {
        this._update = value;
    }

    get installed(): boolean {
        return this._installed;
    }

    set installed(value: boolean) {
        this._installed = value;
    }

    get debug(): { database: boolean, data: boolean } {
        return this._debug;
    }

    set debug(value: { database: boolean, data: boolean }) {
        this._debug = value;
    }

    public save(): void {
        writeFile('./config.json', JSON.stringify(this.toJSON(), null, 2), 'utf8', err => {
            if (err) {
                Log.error(err.message, 'Config');
                return;
            }
            if (this.debug.data) Log.debug('Saving config...', 'Config')
            this.config = require(this.path)
        });
    }

    public toJSON(): any {
        return {
            "siteName": this.siteName,
            "lang": this.lang,
            "ssl": this.ssl,
            "options": {
                "key": this.options.key,
                "cert": this.options.cert,
                "ca": this.options.ca
            },
            "ports": {
                "insecure": this.ports.insecure,
                "secure": this.ports.secure
            },
            "mysql": {
                "host": this.mysql.host,
                "port": this.mysql.port,
                "db": this.mysql.db,
                "user": this.mysql.user,
                "password": this.mysql.password
            },
            "update": this.update,
            "installed": this.installed,
            "debug": {
                "database": this.debug.database,
                "data": this.debug.data
            }
        }
    }
}