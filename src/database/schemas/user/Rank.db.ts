/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
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
    priority: {
        type: Number,
        default: 0
    },
    displayName: {
        type: String,
        required: true
    },
    css: {
        type: String,
        default: 'span.tag',
        required: true
    },
    block: {
        type: Boolean,
        default: true,
        required: true
    },
    permissions: {
        type: [String],
        default: [],
        required: true
    },
    parent: {
        type: String,
    }
});

export default RankSchema;

export interface IRank {
    uuid: string
    name: string
    priority: number
    displayName: string
    css: string
    block: boolean
    permissions: string[]
    parent: string
}

export interface IRankDocument extends IRank, Document{}
export interface IRankModel extends Model<IRankDocument>{}

export const RankModel: Model<IRankDocument> = model<IRankDocument>('Rank', RankSchema);

export function loadDefaultRanks(): void {
    // Deletes ALL Ranks from the db and loads them
    RankModel.deleteMany({});
    RankModel.insertMany(require('../../../data/default/ranks.json'));
}