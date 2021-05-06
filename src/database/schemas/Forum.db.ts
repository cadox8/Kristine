/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 6/5/21 18:58
 */

import {Document, model, Model, Schema} from "mongoose";

const ForumSchema: Schema = new Schema({
    uuid: {
        type: String,
        required: true
    },
    category: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        default: ''
    },
    hidden: {
        type: Boolean,
        default: false
    },
    permissions: {
        type: Number,
        default: 0
    }
});

export default ForumSchema;

export interface IForum {
    uuid: string
    category: string
    title: string
    description: string
    hidden: boolean
    permissions: number
}

export interface IForumDocument extends IForum, Document{}
export interface IForumModel extends Model<IForumDocument>{}

export const ForumModel: Model<IForumDocument> = model<IForumDocument>('Forum', ForumSchema);
