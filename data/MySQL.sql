CREATE TABLE IF NOT EXISTS `users` (
  `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(50)      NOT NULL DEFAULT '',
  `email`      VARCHAR(100)     NOT NULL,
  `pass`       VARCHAR(50)      NOT NULL,
  `rank`       INT(8)           NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name` (`name`),
  UNIQUE INDEX `email` (`email`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `cat` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(36)      NOT NULL DEFAULT '',
  `desc`        VARCHAR(500)     NOT NULL DEFAULT '',
  `access`      INT(8)           NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `forum` (
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(500)     NOT NULL DEFAULT '',
  `desc`        VARCHAR(500)     NOT NULL DEFAULT '',
  `cat`         INT(11)          NOT NULL DEFAULT 1,
  `access`      INT(8)           NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE IF NOT EXISTS `posts` (
  `id`          INT(11)     UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(500)         NOT NULL DEFAULT '',
  `content`     LONGTEXT             NOT NULL DEFAULT '',
  `author`      INT(11)              NOT NULL DEFAULT 1,
  `likes`       INT(11)              NOT NULL DEFAULT 0,
  `forum`       INT(11)              NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE INDEX (`id`),
  UNIQUE INDEX (`title`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;


INSERT INTO `users` (name, email, pass) VALUES ('Kristine', 'kristine@cadox8.me', 'MTIz');

INSERT INTO `cat` (title, `desc`) VALUES ('General', 'Default category');
INSERT INTO `forum` (title, `desc`, cat) VALUES ('First Forum', 'Default Forum', 1);
INSERT INTO `posts` (title, content, author, likes, forum) VALUES ('My First Post', 'Congrats, you have just installed Kristine! :D', 1, 0, 1)