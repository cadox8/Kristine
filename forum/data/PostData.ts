/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Author} from "./Author";

export class PostData {

    private readonly _id: number;
    private _title: string;
    private _content: string;

    private _forumId: number;

    private _author: Author;
    private _likes: number;
    private _date: Date;

    constructor(id: number) {
        this._id = id;
    }


    get id(): number {
        return this._id;
    }

    get title(): string {
        return this._title;
    }

    get content(): string {
        return this._content;
    }

    get forumId(): number {
        return this._forumId;
    }

    get author(): Author {
        return this._author;
    }

    get likes(): number {
        return this._likes;
    }

    get date(): Date {
        return this._date;
    }


    set title(value: string) {
        this._title = value;
    }

    set content(value: string) {
        this._content = value;
    }

    set forumId(value: number) {
        this._forumId = value;
    }

    set author(value: Author) {
        this._author = value;
    }

    set likes(value: number) {
        this._likes = value;
    }

    set date(value: Date) {
        this._date = value;
    }
}