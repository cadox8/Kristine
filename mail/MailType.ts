/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import mjml2html from "mjml";

export class MailType {

    private readonly _subject: string;
    private readonly _text: string;
    private readonly _html: string;

    private constructor(subject: string, text: string, html: string) {
        this._subject = subject;
        this._text = text;
        this._html = html;
    }

    public static VERIFICATION(): MailType {
        return new MailType('Verify your Kristine Account', '', mjml2html('<mjml>\n' +
            '  <mj-body background-color="#34495e">\n' +
            '    <mj-section>\n' +
            '      <mj-column>\n' +
            '        <mj-image width="100px" src="https://raw.githubusercontent.com/cadox8/Kristine/master/docs/img/kristine.jpg"></mj-image>\n' +
            '        <mj-divider border-color="#3498db"></mj-divider>\n' +
            '        <mj-text font-size="16px" color="#fff" font-family="helvetica">Thanks for signing up for your Kristine account! Please verify your email using the link below and you will receive a confirmation once verification is complete.</mj-text>\n' +
            '        <mj-button font-family="Helvetica" font-size="16px" background-color="#3498db" color="black">Verify Account &rarr;</mj-button>\n' +
            '      </mj-column>\n' +
            '    </mj-section>\n' +
            '  </mj-body>\n' +
            '</mjml>', {
            beautify: true,
            minify: true,
            minifyOptions: {
                collapseWhitespace: true,
                minifyCSS: true,
                removeEmptyAttributes: true
            }
        }).html);
    }


    get subject(): string {
        return this._subject;
    }

    get text(): string {
        return this._text;
    }

    get html(): string {
        return this._html;
    }
}