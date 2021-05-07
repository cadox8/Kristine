/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {model, Model, Schema, Document} from "mongoose";

const AdminLogSchema: Schema = new Schema({
    user: {
        type: String,
        required: true
    },
    action: {
        type: String,
        required: true
    },
    when: {
        type: Number,
        default: Date.now()
    }
});

export default AdminLogSchema;

export interface IAdminLog {
    uuid: string
    user: string
    reason: string
    bannedAt: number
    until: number
    by: string
}

export interface IAdminLogDocument extends IAdminLog, Document{}
export interface IAdminLogModel extends Model<IAdminLogDocument>{}

export const AdminLogModel: Model<IAdminLogDocument> = model<IAdminLogDocument>('AdminLog', AdminLogSchema);