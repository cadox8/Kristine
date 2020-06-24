/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {Forum} from "../forum/Forum";

const Logger = require("@ptkdev/logger");

const options = {
    "language": "en",
    "colors": true,
    "debug": true,
    "info": true,
    "warning": true,
    "error": true,
    "write": true,
    "type": "log",
    "path": {
        "debug_log": "./log/debug.log",
        "error_log": "./log/errors.log",
    },
    "rotate": {
        "size": "10M",
        "encoding": "utf8"
    },
    "palette": {
        "info": {
            "label": "#ffffff",
            "text": "#4CAF50",
            "background": "#4CAF50"
        },
        "warning": {
            "label": "#ffffff",
            "text": "#FF9800",
            "background": "#FF9800"
        },
        "error": {
            "label": "#ffffff",
            "text": "#FF5252",
            "background": "#FF5252"
        },
        "stackoverflow": {
            "label": "#ffffff",
            "text": "#9C27B0",
            "background": "#9C27B0"
        },
        "docs": {
            "label": "#ffffff",
            "text": "#FF4081",
            "background": "#FF4081"
        },
        "debug": {
            "label": "#ffffff",
            "text": "#1976D2",
            "background": "#1976D2"
        },
        "sponsor": {
            "label": "#ffffff",
            "text": "#607D8B",
            "background": "#607D8B"
        }
    }
};

const logger = new Logger(options);

export class Log {

    public static debugData(msg: string, tag: string = ''): void {
        if (Forum.instance.config.debug.data) Log.debug(msg, tag);
    }

    public static debug(msg: string, tag: string = ''): void {
        logger.debug(msg, tag);
    }

    public static success(msg: string, tag: string = ''):void {
        logger.info(msg, tag);
    }

    public static error(msg: string, tag: string = 'Error'):void {
        logger.error(msg, tag);
    }

    public static warning(msg: string, tag: string = ''):void {
        logger.warning(msg, tag);
    }

    public static log(msg: string, tag: string = ''):void {
        logger.info(msg, tag);
    }

    public static spacer(where: number): void {
        if (where === 0) Log.debug('');
        Log.debug('----------------------');
        if (where === 1) Log.debug('');
    }
}