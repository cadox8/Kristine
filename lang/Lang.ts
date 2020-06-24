/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

export class Lang {

    // Lang files
    private static en_GB = require('./files/en_GB.json');

    //

    private readonly lang: string;

    constructor(lang: string) {
        this.lang = lang;
    }

    public getLang(data: string): string {
        let langFile;

        switch (this.lang) {
            case 'en_GB':
                langFile = Lang.en_GB;
                break;
            default:
                langFile = Lang.en_GB;
                break;
        }
        let text: string = 'Error while getting lang (' + data + ')';
        const parts = data.split(".");

        switch (parts.length) {
            case 0:
                text = langFile[text];
                break;
            case 1:
                text = langFile[parts[0]];
                break;
            case 2:
                text = langFile[parts[0]][parts[1]];
                break;
            case 3:
                text = langFile[parts[0]][parts[1]][parts[2]];
                break;
            case 4:
                text = langFile[parts[0]][parts[1]][parts[2]][parts[3]];
                break;
            case 5:
                text = langFile[parts[0]][parts[1]][parts[2]][parts[3]][parts[4]];
                break;
        }
        return text;
    }
}