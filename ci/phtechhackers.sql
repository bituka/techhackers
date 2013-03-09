-- reddit.sql

CREATE TABLE posts (
 `id` INT(11),
 `title` TEXT,
 `url` TEXT,
 `userid` INT(11), 
 `votes` INT(11),
 `commentcount` INT(11),
 `created_at` DATETIME,
 `updated_at` TIMESTAMP,
 PRIMARY KEY (`id`)
);

CREATE TABLE members (
 `id` INT(11),
 `username` VARCHAR(25),
 `password` VARCHAR(45),
 `email` VARCHAR(40),
 `created_at` DATETIME,
 `updated_at` TIMESTAMP,
 PRIMARY KEY (`id`)
);

CREATE TABLE events (
 `id` INT(11),
 `memid` INT(11),
 `eventname` TEXT,
 `when` DATE,
 `time` VARCHAR(10),
 `created_at` DATETIME,
 `updated_at` TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE comments (
 `id` INT(11),
 `memid` VARCHAR(25),
 `pid` INT(11),
 `comment` TEXT,
 `created_at` DATETIME,
  PRIMARY KEY (`id`)
);