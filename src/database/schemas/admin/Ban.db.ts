/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {model, Model, Schema, Document} from "mongoose";

const BanSchema: Schema = new Schema({
    uuid: {
        type: String,
        required: true
    },
    user: {
        type: String,
        required: true
    },
    reason: {
        type: String,
        default: 'No reason'
    },
    bannedAt: {
        type: Number,
        default: Date.now()
    },
    until: {
        type: Number,
        default: -1, // -1 Means forever
    },
    by: {
        type: String,
        required: true
    }
});

export default BanSchema;

export interface IBan {
    uuid: string
    user: string
    reason: string
    bannedAt: number
    until: number
    by: string
}

export interface IBanDocument extends IBan, Document{}
export interface IBanModel extends Model<IBanDocument>{}

export const BanModel: Model<IBanDocument> = model<IBanDocument>('Ban', BanSchema);