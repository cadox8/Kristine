/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Post} from "./Post";
import {Database} from "../../db/Database";

export class Forum {

    private readonly _id: number;
    private _title: string;
    private _description: string;

    private _catId: number;

    private _access: number;
    private _hidden: boolean;

    private _read: boolean = false;

    private _posts: Post[] = [];

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

    get catId(): number {
        return this._catId;
    }

    get access(): number {
        return this._access;
    }

    get hidden(): boolean {
        return this._hidden;
    }

    get posts(): Post[] {
        return this._posts;
    }

    get read(): boolean {
        return this._read;
    }

    set read(value: boolean) {
        this._read = value;
    }

    set title(value: string) {
        this._title = value;
    }

    set description(value: string) {
        this._description = value;
    }

    set catId(value: number) {
        this._catId = value;
    }

    set access(value: number) {
        this._access = value;
    }

    set hidden(value: boolean) {
        this._hidden = value;
    }

    set posts(value: Post[]) {
        this._posts = value;
    }
}