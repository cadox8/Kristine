/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Permissions} from "./Permissions";

export class Rank {

    private readonly _id: number;
    private _name: string;

    private _rank: number;

    private _permissions: Permissions[];


    constructor(id: number) {
        this._id = id;
    }


    get id(): number {
        return this._id;
    }

    get name(): string {
        return this._name;
    }

    set name(value: string) {
        this._name = value;
    }

    get rank(): number {
        return this._rank;
    }

    set rank(value: number) {
        this._rank = value;
    }

    get permissions(): Permissions[] {
        return this._permissions;
    }

    set permissions(value: Permissions[]) {
        this._permissions = value;
    }
}

export function defaultRanks(): Rank[] {
    const ranks: Rank[] = [];

    const user: Rank = new Rank(1);
    user.name = 'User';
    user.rank = 1000;
    user.permissions = [];

    const admin: Rank = new Rank(4);
    admin.name = 'Admin';
    admin.rank = 100;
    admin.permissions = [Permissions.ADMIN_PANEL];

    ranks.push(user, admin)
    return ranks;
}