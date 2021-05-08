/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {model, Model, Schema, Document} from "mongoose";
import {loadDefaultRanks} from "./Rank.db";

const PermissionSchema: Schema = new Schema({
    permission: {
        type: String,
        required: true
    },
    description: {
        type: String,
        default: ''
    },
    group: {
        type: String,
        default: ''
    },
    generator: {
        type: String,
        required: true
    },
    depends: {
        type: Array,
        default: []
    }
});

export default PermissionSchema;

export interface IPermission {
    permissions: string
    description: string
    group: string
    generator: string
    depends: string[]
}

export interface IPermissionDocument extends IPermission, Document{}
export interface IPermissionModel extends Model<IPermissionDocument>{}

export const PermissionModel: Model<IPermissionDocument> = model<IPermissionDocument>('Permission', PermissionSchema);

export function loadDefaultPermissions(): void {
    // Deletes ALL Permissions from the db and loads them
    PermissionModel.deleteMany({});
    PermissionModel.insertMany(require('../../../data/default/permissions.json'));
    // Now lets add some ranks
    loadDefaultRanks();
}