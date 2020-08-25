/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

import {createTransport} from "nodemailer";
import Mail from "nodemailer/lib/mailer";
import {MailType} from "./MailType";

export class Mailer {

    private readonly sender: Mail;

    private readonly email: { from: string, host: string, port: number, user: string, password: string }

    constructor(email: { from: string, host: string, port: number, user: string, password: string }) {
        this.email.from = email.from;
        this.email.host = email.host;
        this.email.port = email.port;
        this.email.user = email.user;
        this.email.password = email.password;

        this.sender = this.connect();
    }

    private connect(): Mail {
        return createTransport({
            host: this.email.host,
            port: this.email.port,
            secure: this.email.port == 465,
            auth: {
                user: this.email.user,
                pass: this.email.password
            },
        });
    };

    public async sendMail(to: string, type: MailType): Promise<void> {
        await this.sender.sendMail({
            from: this.email.from,
            to: to,
            subject: type.subject,
            text: type.text,
            html: type.html
        });
    }
}