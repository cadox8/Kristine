/*
 * Copyright (c) 2021. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

create database if not exists kristine;

use kristine;

/* Forum Table */
create table if not exists `cat`
(
    id          int(255) unsigned not null auto_increment,
    title       varchar(255)      not null default '',
    description varchar(255)      not null default '',
    hidden      bit(1)            not null default 0,
    primary key (id)
) engine = InnoDB
  default charset = utf8;

create table if not exists `forum`
(
    id          int(255) unsigned not null auto_increment,
    title       varchar(255)      not null default '',
    description varchar(255)      not null default '',
    cat         int(255) unsigned not null default 1,
    hidden      bit(1)            not null default 0,
    primary key (id)
) engine = InnoDB
  default charset = utf8;

CREATE TABLE IF NOT EXISTS `posts`
(
    `id`      INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`   VARCHAR(100)      NOT NULL DEFAULT '',
    `content` LONGTEXT          NOT NULL,
    `author`  INT(11)           NOT NULL DEFAULT 1,
    `likes`   INT(11)           NOT NULL DEFAULT 0,
    `forum`   INT(255) unsigned NOT NULL DEFAULT 1,
    `date`    TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/* User Table */
CREATE TABLE IF NOT EXISTS `users`
(
    `id`         INT(255) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username`   VARCHAR(255)      NOT NULL DEFAULT '',
    `name`       VARCHAR(255)      NOT NULL DEFAULT '',
    `email`      VARCHAR(255)      NOT NULL,
    `uuid`       VARCHAR(255)      NOT NULL DEFAULT '',
    `hash`       VARCHAR(255)      NOT NULL,
    `rank`       INT(8)            NOT NULL DEFAULT 1,
    `lang`       VARCHAR(5)        NOT NULL DEFAULT 'en_EN',
    `birthday`   TIMESTAMP         NULL,
    `gender`     INT(1)            NOT NULL DEFAULT 0, /* 0 men, 1 women */
    `location`   VARCHAR(5000)     NULL,
    `firstJoin`  TIMESTAMP         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `points`     INT(100)          NOT NULL DEFAULT 0,
    `icon`       VARCHAR(50)       NOT NULL DEFAULT 'user.png',
    `signature`  VARCHAR(5000)     NOT NULL DEFAULT '',
    `showOnline` INT(1)            NOT NULL DEFAULT 0, /* 0 -> No, 1 -> Yes */
    `showBirth`  INT(1)            NOT NULL DEFAULT 1,
    `active`     INT(1)            NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE INDEX (`username`),
    unique index (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/* Social Table */
CREATE TABLE IF NOT EXISTS `social`
(
    `id`       INT(100) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user`     INT(255) unsigned NOT NULL,
    `twitter`  VARCHAR(255)      NOT NULL DEFAULT '',
    `facebook` VARCHAR(255)      NOT NULL DEFAULT '',
    `skype`    VARCHAR(50)       NOT NULL DEFAULT '',
    `github`   VARCHAR(255)      NOT NULL DEFAULT '',
    `youtube`  VARCHAR(255)      NOT NULL DEFAULT '',
    `twitch`   VARCHAR(50)       NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE INDEX (`user`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

/* Achievement Table */
CREATE TABLE IF NOT EXISTS `achie`
(
    `id`     INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title`  VARCHAR(100)     NOT NULL,
    `desc`   VARCHAR(255)     NOT NULL,
    `icon`   VARCHAR(255)     NOT NULL,
    `user`   INT(100)         NOT NULL,
    `points` INT(11)          NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`),
    UNIQUE INDEX (`title`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;


INSERT INTO `cat` (title, `description`)
VALUES ('General', 'Default category');
INSERT INTO `forum` (title, `description`, cat)
VALUES ('First Forum', 'Default Forum', 1);
INSERT INTO `posts` (title, content, author, likes, forum)
VALUES ('My First Post', 'Congrats, you have just installed Kristine! :D', 1, 0, 1);

INSERT INTO `achie` (title, `desc`, icon, user, points)
VALUES ('Developer', 'You developed Kristine!', 'dev', 1, 5);

INSERT INTO `users` (username, name, email, hash, `rank`, lang, birthday, gender, location, firstJoin, points, icon,
                     signature, showOnline, showBirth, active)
VALUES ('kristine', 'kristine', 'kristine@kristine.es', '$2a$10$eN6vjTur9/Uddqi7RF6tBONNeEQjpuy8oO.F.7baW1Yib01jQXTFe',
        0, 'en_EN', null, 0, null, '2020-06-14 19:09:44', 0, '', '', 0, 1, 0);