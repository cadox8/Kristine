/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 * This file is created on 6/5/21 20:36
 */

import {Document, model, Model, Schema} from "mongoose";

const UserSchema: Schema = new Schema({
    uuid: {
        type: String,
        required: true
    },
    username: {
        type: String,
        required: true
    },
    name: {
        type: String,
        required: true
    },
    email: {
        type: String,
        required: true
    },
    hash: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        default: '',
        required: true
    },
    ranks: {
        type: [String],
        default: [ "6c47526c-4a38-4789-afb0-e149bc8cb6bc" ],
        required: true,
    },
    permissions: {
        type: [String],
        default: [],
        required: true
    },
    administrator: {
        type: Boolean,
        default: false,
        required: true
    },
    ban: {
        type: Boolean,
        default: false,
        required: true
    }
});

export default UserSchema;

export interface IUser {
    uuid: string
    username: string
    name: string
    email: string
    hash: string
    icon: string
    ranks: string[]
    permissions: string[]
    administrator: boolean
    ban: boolean
}

export interface IUserDocument extends IUser, Document{}
export interface IUserModel extends Model<IUserDocument>{}

export const UserModel: Model<IUserDocument> = model<IUserDocument>('User', UserSchema);