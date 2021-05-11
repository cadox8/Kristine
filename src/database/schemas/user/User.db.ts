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
import {v4} from "uuid";

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
        default: ''
    },
    ranks: {
        type: [String],
        default: [ "6c47526c-4a38-4789-afb0-e149bc8cb6bc" ]
    },
    permissions: {
        type: [String],
        default: []
    },
    administrator: {
        type: Boolean,
        default: false
    },
    ban: {
        type: Boolean,
        default: false
    },
    lang: {
        type: String,
        default: 'en-GB'
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
    lang: string
}

export interface IUserDocument extends IUser, Document{}
export interface IUserModel extends Model<IUserDocument>{}

export const UserModel: Model<IUserDocument> = model<IUserDocument>('User', UserSchema);

export async function createUser(username: string, email: string, hash: string, name?: string, administrator?: boolean): Promise<boolean> {
    return new Promise(async created => {
        if (await existsUser(username, email)) created(false);
        UserModel.create({ uuid: v4(), username: username, email: email, hash: hash, name: name || username, administrator: administrator || false });
        created(true);
    })
}

export async function existsUser(username: string, email: string): Promise<boolean> {
    return UserModel.exists({ $or: [{ username: username }, { email: email }] });
}