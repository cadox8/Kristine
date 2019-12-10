/* Our Database */
CREATE DATABASE kristine;
USE kristine;

/* Forum Tables */
CREATE TABLE IF NOT EXISTS `cat` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(36)      NOT NULL DEFAULT '',
  `desc`        VARCHAR(500)     NOT NULL DEFAULT '',
  `access`      INT(2)           NOT NULL DEFAULT 0,
  `priority`    INT(2)           NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `forum` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(100)     NOT NULL DEFAULT '',
  `desc`        VARCHAR(100)     NOT NULL DEFAULT '',
  `cat`         INT(11)          NOT NULL DEFAULT 1,
  `access`      INT(2)           NOT NULL DEFAULT 0,
  `priority`    INT(2)           NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `posts` (
  `id`          INT(11)     UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(100)         NOT NULL DEFAULT '',
  `content`     LONGTEXT             NOT NULL DEFAULT '',
  `author`      INT(11)              NOT NULL DEFAULT 1,
  `likes`       INT(11)              NOT NULL DEFAULT 0,
  `forum`       INT(11)              NOT NULL DEFAULT 1,
  `date`        TIMESTAMP            NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

/* User Tables */
CREATE TABLE IF NOT EXISTS `users` (
  `id`            INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`          VARCHAR(50)      NOT NULL DEFAULT '',
  `email`         VARCHAR(100)     NOT NULL,
  `pass`          VARCHAR(100)     NOT NULL,
  `hash`          VARCHAR( 32 )    NOT NULL ,
  `rank`          INT(8)           NOT NULL DEFAULT 0,
  `lang`          VARCHAR(5)       NOT NULL DEFAULT 'en_EN',
  `birthday`      TIMESTAMP        NULL,
  `gender`        INT(1)           NOT NULL DEFAULT 0, /* 0 men, 1 women */
  `location`      VARCHAR(5000)    NULL,
  `firstJoin`     TIMESTAMP        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `twitter`       VARCHAR(50)      NOT NULL DEFAULT '',
  `facebook`      VARCHAR(50)      NOT NULL DEFAULT '',
  `skype`         VARCHAR(50)      NOT NULL DEFAULT '',
  `points`        INT(11)          NOT NULL DEFAULT 0,
  `icon`          VARCHAR(50)      NOT NULL DEFAULT '',
  `signature`     VARCHAR(5000)    NOT NULL DEFAULT '',
  `showOnline`    INT(1)           NOT NULL DEFAULT 0, /* 0 -> No, 1 -> Yes */
  `showBirth`     INT(1)           NOT NULL DEFAULT 1,
  `active`        INT(1)           NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name` (`name`),
  UNIQUE INDEX `email` (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `achie` (
  `id`          INT(11)     UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(100)         NOT NULL,
  `desc`        VARCHAR(255)         NOT NULL,
  `icon`        VARCHAR(255)         NOT NULL,
  `user`        INT(11)              NOT NULL,
  `points`      INT(11)              NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


INSERT INTO `users` (name, email, pass, gender, active) VALUES ('Kristine', 'kristine@cadox8.me', 'MTIz', 1, 1);

INSERT INTO `cat` (title, `desc`) VALUES ('General', 'Default category');
INSERT INTO `forum` (title, `desc`, cat) VALUES ('First Forum', 'Default Forum', 1);
INSERT INTO `posts` (title, content, author, likes, forum) VALUES ('My First Post', 'Congrats, you have just installed Kristine! :D', 1, 0, 1);

INSERT INTO `achie` (title, `desc`, icon, user, points) VALUES ('Developer', 'You developed Kristine!', 'dev', 1, 5);
