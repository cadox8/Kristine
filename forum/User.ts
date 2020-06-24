/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Rank} from "./ranks/Rank";
import {Forum} from "./Forum";
import {Permissions} from "./ranks/Permissions";

export class User {

    private readonly _id: number;

    private readonly _email: string;

    private readonly _username: string;
    private _name: string;

    private _lang: string;
    private _icon: string;

    private _rank: Rank;

    constructor(id: number, username: string, rank: number, name: string, email: string, lang: string, icon: string) {
        this._id = id;
        this._username = username;
        this._name = name;
        this._email = email;
        this._lang = lang;
        this._icon = icon;

        this._rank = Forum.instance.getRank(rank);
    }

    get id(): number {
        return this._id;
    }

    get email(): string {
        return this._email;
    }

    get username(): string {
        return this._username;
    }

    get name(): string {
        return this._name;
    }

    get lang(): string {
        return this._lang;
    }

    get icon(): string {
        return this._icon;
    }

    get rank(): Rank {
        return this._rank;
    }

    set name(value: string) {
        this._name = value;
    }

    set lang(value: string) {
        this._lang = value;
    }

    set icon(value: string) {
        this._icon = value;
    }

    set rank(value: Rank) {
        this._rank = value;
    }

    public toJSON(): any {
        return {
            id: this.id,
            email: this.email,
            username: this.username,
            name: this.name,
            lang: this.lang,
            icon: this.icon,
            rank: {
                id: this.rank.id,
                name: this.rank.name,
                rank: this.rank.rank,
                permissions: this.rank.permissions
            }
        };
    }
}