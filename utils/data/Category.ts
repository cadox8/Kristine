/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Forum} from "./Forum";
import {Database} from "../../db/Database";

export class Category {

    private readonly _id: number;
    private _title: string = '';
    private _description: string = '';

    private _access: number = 0;
    private _hidden: boolean = false;

    private _forums: Forum[] = [];

    constructor(id: number) {
        this._id = id;
    }


    get id(): number {
        return this._id;
    }

    get title(): string {
        return this._title;
    }

    get description(): string {
        return this._description;
    }

    get access(): number {
        return this._access;
    }

    get hidden(): boolean {
        return this._hidden;
    }

    get forums(): Forum[] {
        return this._forums;
    }


    set title(value: string) {
        this._title = value;
    }

    set description(value: string) {
        this._description = value;
    }

    set access(value: number) {
        this._access = value;
    }

    set hidden(value: boolean) {
        this._hidden = value;
    }

    set forums(value: Forum[]) {
        this._forums = value;
    }
}