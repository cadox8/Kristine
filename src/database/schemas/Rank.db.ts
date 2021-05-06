/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 6/5/21 19:15
 */

import {Document, model, Model, Schema} from "mongoose";

const RankSchema: Schema = new Schema({
    uuid: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    order: {
        type: Number,
        default: 0
    },
    color: {
        type: String,
        default: 'ffffff'
    },
    permissions: {
        type: Number,
        default: 0
    }
});

export default RankSchema;

export interface IRank {
    uuid: string
    name: string
    order: number
    permissions: number
}

export interface IRankDocument extends IRank, Document{}
export interface IRankModel extends Model<IRankDocument>{}

export const RankModel: Model<IRankDocument> = model<IRankDocument>('Rank', RankSchema)