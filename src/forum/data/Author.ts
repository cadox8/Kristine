/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 4/5/21 20:37
 */

export class Author {

    public readonly id: number;
    public readonly uuid: string;

    public readonly name: string;
    public readonly icon: string;

    constructor(id: number, uuid: string, name: string, icon: string) {
        this.id = id;
        this.uuid = uuid;
        this.name = name;
        this.icon = icon;
    }
}