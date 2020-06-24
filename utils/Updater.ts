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

export class Updater {

    public getData(): any {
        let data: any = {
            "latest_version": Website.VERSION_DATA,
            "beta_version": Website.VERSION_DATA,
            "versions": [
                {
                    "version_id": Website.VERSION_DATA,
                    "version": Website.VERSION
                }
            ]
        };
        fetch('https://cadox8.github.io/Kristine/versions.json').then(response => {
            if (!response.ok) return {
                "latest_version": Website.VERSION_DATA,
                "beta_version": Website.VERSION_DATA,
                "versions": [
                    {
                        "version_id": Website.VERSION_DATA,
                        "version": Website.VERSION
                    }
                ]
            };
           return response.json();
        }).then(json => data = json);
        return data;
    }

    public timeToUpdate(): boolean {
        return this.getData().latest_version > Website.VERSION_DATA;
    }
}