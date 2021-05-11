/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

// This class will handle all defaults values that goes to the website
import {Config} from "../forum/Config";

export class Defaults {

    public siteName: string;
    public theme: string;

    constructor() {
        this.siteName = Config.SITE_NAME();
        this.theme = Config.THEME_COLOR()
    }
}