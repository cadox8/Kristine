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
import {v4} from "uuid";

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
        default: '',
        required: true
    },
    hidden: {
        type: Boolean,
        default: false,
        required: true
    },
    permissions: {
        type: [String],
        default: [],
        required: true
    }
});

export default CategorySchema;

export interface ICategory {
    uuid: string
    title: string
    description: string
    hidden: boolean
    permissions: string[]
}

export interface ICategoryDocument extends ICategory, Document{}
export interface ICategoryModel extends Model<ICategoryDocument>{}

export const CategoryModel: Model<ICategoryDocument> = model<ICategoryDocument>('Category', CategorySchema);

export async function createCategory(title: string, description: string = '', hidden: boolean = false, permissions: number = 0): Promise<void> {
    const uuid: string = v4();

    if (await this.existsCategory(uuid)) await this.createCategory(title, description, hidden, permissions);

    await CategoryModel.create({
        uuid: uuid,
        title: title,
        description: description,
        hidden: hidden,
        permissions: permissions
    });
}

export async function existsCategory(uuid: string): Promise<boolean> {
    return await CategoryModel.exists({ uuid: uuid })
}