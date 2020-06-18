/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

export class Author {

    private readonly _id: number;
    private readonly _uuid: string;

    private readonly _name: string;
    private readonly _icon: string;

    constructor(id: number, uuid: string, name: string, icon: string) {
        this._id = id;
        this._uuid = uuid;
        this._name = name;
        this._icon = icon;
    }


    get id(): number {
        return this._id;
    }

    get uuid(): string {
        return this._uuid;
    }

    get name(): string {
        return this._name;
    }

    get icon(): string {
        return this._icon;
    }
}