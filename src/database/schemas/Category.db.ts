/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 6/5/21 18:30
 */

import {Document, model, Model, Schema} from "mongoose";

const CategorySchema: Schema = new Schema({
    uuid: {
        type: String,
        required: true
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

export default CategorySchema

export interface ICategory {
    uuid: string
    title: string
    description: string
    hidden: boolean
    permissions: number
}

export interface ICategoryDocument extends ICategory, Document{}
export interface ICategoryModel extends Model<ICategoryDocument>{}

export const CategoryModel: Model<ICategoryDocument> = model<ICategoryDocument>('Category', CategorySchema);