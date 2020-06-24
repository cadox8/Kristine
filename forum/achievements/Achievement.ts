/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)} 
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

export class Achievement {

    private readonly _id: number;
    private readonly _name: string;
    private _description: string;
    private _points: number;

    constructor(id: number, name: string) {
        this._id = id;
        this._name = name;
        this._description = 'Default Achievement';
        this._points = 0;
    }


    get id(): number {
        return this._id;
    }

    get name(): string {
        return this._name;
    }

    get description(): string {
        return this._description;
    }

    set description(value: string) {
        this._description = value;
    }

    get points(): number {
        return this._points;
    }

    set points(value: number) {
        this._points = value;
    }
}