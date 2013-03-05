-- reddit.sql

CREATE TABLE links (
 `id` INT(11),
 `title` TEXT,
 `url` TEXT,
 `userid` INT(11), 
 `votes` INT(50),
 `created_at` DATETIME,
 `updated_at` TIMESTAMP,
 PRIMARY KEY (`id`)
);

CREATE TABLE username (
 `id` INT(11)
 `username` VARCHAR(25),
 `password` VARCHAR(45),
 `email` VARCHAR(40),
 `created_at` DATETIME,
 `updated_at` TIMESTAMP,
 PRIMARY KEY (`id`)
);

CREATE TABLE events (
 `id` INT(11)
 `userid` VARCHAR(25),
 `eventname` TEXT,
 `when` DATE,
 `time` VARCHAR(10),
 `created_at` DATETIME,
 `updated_at` TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE comments (
 `id` INT(11)
 `userid` VARCHAR(25),
 `linkid` INT(11),
 `comment` TEXT,
 `created_at` DATETIME,
  PRIMARY KEY (`id`)
);