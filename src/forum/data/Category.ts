/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

import {ForumData} from "./ForumData";

export class Category {

    public readonly id: number;
    public title: string;
    public description: string;

    // ToDo: Permissions
    public hidden: boolean;

    public forums: ForumData[];

    constructor(id: number) {
        this.id = id;

        this.title = '';
        this.description = '';
        this.hidden = false;

        this.forums = [];
    }
}