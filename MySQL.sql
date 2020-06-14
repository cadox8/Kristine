/*
 * Copyright (c) 2020. {cadox8} <{cadox8@gmail.com}>
 *
 * This file is part of {Kristine Forum (https://github.com/cadox8/Kristine)}
 *
 * Check the complete License at [https://github.com/cadox8/Kristine/blob/master/LICENSE]
 *
 */

/* Our Database */
CREATE DATABASE IF NOT EXISTS kristine;
USE kristine;

/* Forum Table */
CREATE TABLE IF NOT EXISTS `cat` (
  `id`          INT(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)      NOT NULL DEFAULT '',
  `desc`        VARCHAR(500)      NOT NULL DEFAULT '',
  `access`      INT(8)            NOT NULL DEFAULT 0,
  `hidden`      INT(1)            NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `forum` (
  `id`          INT(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(255)      NOT NULL DEFAULT '',
  `desc`        VARCHAR(255)      NOT NULL DEFAULT '',
  `cat`         INT(100)          NOT NULL DEFAULT 1,
  `access`      INT(8)            NOT NULL DEFAULT 0,
  `hidden`      INT(1)            NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `posts` (
  `id`          INT(100)     UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(100)         NOT NULL DEFAULT '',
  `content`     LONGTEXT             NOT NULL DEFAULT '',
  `author`      INT(11)              NOT NULL DEFAULT 1,
  `likes`       INT(11)              NOT NULL DEFAULT 0,
  `forum`       INT(100)              NOT NULL DEFAULT 1,
  `date`        TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

/* User Table */
CREATE TABLE IF NOT EXISTS `users` (
  `id`            INT(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(50)      NOT NULL DEFAULT '',
  `email`         VARCHAR(255)     NOT NULL,
  `hash`          VARCHAR(255)     NOT NULL ,
  `rank`          INT(8)           NOT NULL DEFAULT 0,
  `lang`          VARCHAR(5)       NOT NULL DEFAULT 'en_EN',
  `birthday`      TIMESTAMP        NULL,
  `gender`        INT(1)           NOT NULL DEFAULT 0, /* 0 men, 1 women */
  `location`      VARCHAR(5000)    NULL,
  `firstJoin`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `points`        INT(100)         NOT NULL DEFAULT 0,
  `icon`          VARCHAR(50)      NOT NULL DEFAULT '',
  `signature`     VARCHAR(5000)    NOT NULL DEFAULT '',
  `showOnline`    INT(1)           NOT NULL DEFAULT 0, /* 0 -> No, 1 -> Yes */
  `showBirth`     INT(1)           NOT NULL DEFAULT 1,
  `active`        INT(1)           NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name` (`name`),
  UNIQUE INDEX `email` (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

/* Social Table */
CREATE TABLE IF NOT EXISTS `social` (
    `id`        INT(100)UNSIGNED NOT NULL AUTO_INCREMENT,
    `user`      INT(100)         NOT NULL,
    `twitter`   VARCHAR(255)     NOT NULL DEFAULT '',
    `facebook`  VARCHAR(255)     NOT NULL DEFAULT '',
    `skype`     VARCHAR(50)      NOT NULL DEFAULT '',
    `github`    VARCHAR(255)     NOT NULL DEFAULT '',
    `youtube`   VARCHAR(255)     NOT NULL DEFAULT '',
    `twitch`    VARCHAR(50)      NOT NULL DEFAULT '',
    PRIMARY KEY (`id`),
    UNIQUE INDEX `user` (`user`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

/* Achievement Table */
CREATE TABLE IF NOT EXISTS `achie` (
  `id`          INT(11)     UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(100)         NOT NULL,
  `desc`        VARCHAR(255)         NOT NULL,
  `icon`        VARCHAR(255)         NOT NULL,
  `user`        INT(100)             NOT NULL,
  `points`      INT(11)              NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


INSERT INTO `cat` (title, `desc`) VALUES ('General', 'Default category');
INSERT INTO `forum` (title, `desc`, cat) VALUES ('First Forum', 'Default Forum', 1);
INSERT INTO `posts` (title, content, author, likes, forum) VALUES ('My First Post', 'Congrats, you have just installed Kristine! :D', 1, 0, 1);

INSERT INTO `achie` (title, `desc`, icon, user, points) VALUES ('Developer', 'You developed Kristine!', 'dev', 1, 5);
