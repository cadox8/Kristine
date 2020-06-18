/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Application} from "express";

export class Routes {

    private readonly baseURL: string = '../routes/';
    private readonly app: Application;

    constructor(app: Application) {
        this.app = app;
    }

    public loadURLs() {
        this.register('/', 'index');
        this.register('/forum', 'forum')

        this.register('/register', 'users/register');
        this.register('/login', 'users/login');
    }

    private register(url: string, route: string): void {
        this.app.use(url, require(this.__baseRoute(route) + '.ts'));
    }

    private __baseRoute(path: string): string {
        return this.baseURL + path;
    }
}