/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {PostData} from "./PostData";

export class ForumData {

    public readonly id: number;

    public title: string;
    public description: string;

    public catId: number;

    // ToDo: Permissions
    public hidden: boolean;

    public posts: PostData[];

    constructor(id: number) {
        this.id = id;

        this.title = '';
        this.description = '';
        this.catId = -1;
        this.hidden = false;

        this.posts = [];
    }
}