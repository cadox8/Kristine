/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Website} from "../Website";
import fetch from "node-fetch";
import {Log} from "./Log";

export class Updater {

    public async getData(): Promise<any> {
        const response = await fetch('https://cadox8.github.io/Kristine/versions.json');
        // Default data
        let data = {
            "latest_version": Website.VERSION_DATA,
            "beta_version": Website.VERSION_DATA,
            "versions": [
                {
                    "version_id": Website.VERSION_DATA,
                    "version": Website.VERSION
                }
            ]
        };
        if (response.ok) data = await response.json();
        return data;
    }

    public async timeToUpdate(): Promise<void> {
        const data = await this.getData();
        if (data.latest_version > Website.VERSION_DATA) {
            Log.spacer(-1)
            Log.warning('Latest version: ' + data.latest_version + ' (' + data.versions.find(v => v.version_id === data.latest_version).version + ') || Forum Version: ' + Website.VERSION_DATA + ' (' + Website.VERSION + ')', 'Update')
            Log.warning('Hey! Seems that you have an older version of Kristine', 'Update');
            Log.warning('You can update the forum from the Admin Section', 'Update');
            Log.warning('Or download the latest version from https://github.com/cadox8/Kristine/releases', 'Update')
        }
    }
}