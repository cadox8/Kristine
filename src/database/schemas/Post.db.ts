/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 6/5/21 19:02
 */

import {Document, model, Model, Schema} from "mongoose";
import {CategoryModel} from "./Category.db";

const PostSchema: Schema = new Schema({
    uuid: {
        type: String,
        required: true
    },
    forum: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        required: true
    },
    content: {
        type: String,
        required: true
    },
    author: {
        type: Object,
        required: true
    },
    likes: {
        type: Number,
        default: 0
    },
    postDate: {
        type: Date,
        default: Date.now()
    },
    sticky: {
        type: Boolean,
        default: false
    },
    locked: {
        type: Boolean,
        default: false
    },
    allowComments: {
        type: Boolean,
        default: true
    }
});

export default PostSchema;

export interface IPost {
    uuid: string
    forum: string
    title: string
    content: string
    author: {
        uuid: string
        name: string
        icon: string
    }
    likes: number
    postDate: number
    sticky: boolean
    locked: boolean
    allowComments: boolean
}

export interface IPostDocument extends IPost, Document{}
export interface IPostModel extends Model<IPostDocument>{}

export const PostModel: Model<IPostDocument> = model<IPostDocument>('Post', PostSchema);

export async function existsPost(uuid: string): Promise<boolean> {
    return await PostModel.exists({ uuid: uuid })
}