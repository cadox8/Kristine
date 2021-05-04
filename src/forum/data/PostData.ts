/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {Author} from "./Author";

export class PostData {

    public readonly id: number;
    public title: string;
    public content: string;

    public forumId: number;

    public author: Author;
    public likes: number;
    public date: number;

    constructor(id: number) {
        this.id = id;

        this.title = '';
        this.content = '';
        this.forumId = -1;
        this.author = null;
        this.likes = 0;
        this.date = Date.now();
    }
}