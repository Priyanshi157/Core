create database if not exists poll;
use poll;

CREATE TABLE if not exists users (
  `userId` BIGINT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(48) NULL DEFAULT NULL,
  `middleName` VARCHAR(48) NULL DEFAULT NULL,
  `lastName` VARCHAR(48) NULL DEFAULT NULL,
  `mobile` VARCHAR(16) NULL,
  `email` VARCHAR(50) NULL,
  `passwordHash` VARCHAR(32) NOT NULL,
  `host` TINYINT(1) NOT NULL DEFAULT 0,
  `registeredAt` DATETIME NOT NULL,
  `lastLogin` DATETIME NULL DEFAULT NULL,
  `intro` TINYTEXT NULL DEFAULT NULL,
  `profile` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`userId`)
);

SELECT * FROM `poll`.`users`;

INSERT INTO `poll`.`users` (`userId`, `firstName`, `lastName`, `mobile`, `email`, `passwordHash`, `host`, `registeredAt`) 
VALUES ('1', 'priyanshi', 'lunawat', '9874587895', 'priyanshi@gmail.com', '11111111', '1', '2022-01-01');
INSERT INTO `poll`.`users` (`userId`, `firstName`, `lastName`, `mobile`, `email`, `passwordHash`, `host`, `registeredAt`) 
VALUES ('2', 'krishna', 'makwana', '8748888888', 'krishna@gmail.com', '11111111', '0', '2021-01-12');
INSERT INTO `poll`.`users` (`userId`, `firstName`, `lastName`, `mobile`, `email`, `passwordHash`, `host`, `registeredAt`,`lastLogin`) 
VALUES ('3', 'disha', 'makwana', '8748888888', 'disha@gmail.com', '11111111', '0', '2021-01-12','2022-01-20');
UPDATE `poll`.`users` SET `lastLogin` = '2022-01-15' WHERE (`userId` = '2');
UPDATE `poll`.`users` SET `email` = 'disha@yahool.com' WHERE (`userId` = '3');

CREATE TABLE if not exists poll (
  `pollId` BIGINT NOT NULL AUTO_INCREMENT,
  `userId` BIGINT NOT NULL,
  `title` VARCHAR(75) NOT NULL,
  `metaTitle` VARCHAR(100) NULL,
  `slug` VARCHAR(100) NOT NULL,
  `summary` TINYTEXT NULL,
  `type` SMALLINT(6) NOT NULL DEFAULT 0,
  `published` TINYINT(1) NOT NULL DEFAULT 0,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `publishedAt` DATETIME NULL DEFAULT NULL,
  `startsAt` DATETIME NULL DEFAULT NULL,
  `endsAt` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`pollId`),
  foreign key(userId)references users(userId)
);

SELECT * FROM `poll`.`poll`;

INSERT INTO `poll`.`poll` (`pollId`, `userId`, `title`, `metaTitle`, `slug`, `summary`, `type`, `published`, `createdAt`) 
VALUES ('1', '1', 'abc', 'yjhgfvb', 'rjgfvb', 'gdbc', '1', '1', '2021-12-12');
INSERT INTO `poll`.`poll` (`pollId`, `userId`, `title`, `metaTitle`, `slug`, `summary`, `type`, `published`, `createdAt`) 
VALUES ('2', '2', 'xyz', 'kjfsn', 'khjvnm', 'ekjsfxnc', '2', '0', '2022-01-01');
INSERT INTO `poll`.`poll` (`pollId`, `userId`, `title`, `metaTitle`, `slug`, `summary`, `type`, `published`, `createdAt` , `publishedAt`) 
VALUES ('3', '2', 'xyz', 'kjfsn', 'khjvnm', 'ekjsfxnc', '2', '0', '2022-01-01','2021-01-01');
UPDATE `poll`.`poll` SET `startsAt` = '2022-01-01', `endsAt` = '2022-01-23' WHERE (`pollId` = '3');


CREATE TABLE if not exists pollMeta (
  `pollMetaId` BIGINT NOT NULL AUTO_INCREMENT,
  `pollId` BIGINT NOT NULL,
  `key` VARCHAR(50) NOT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`pollMetaId`),
  foreign key(pollId)references poll(pollId)
);

SELECT * FROM `poll`.`pollMeta`;

INSERT INTO `poll`.`pollMeta` (`pollMetaId`, `pollId`, `key`) VALUES ('1', '1', 'hello');
INSERT INTO `poll`.`pollMeta` (`pollMetaId`, `pollId`, `key`) VALUES ('2', '2', 'hello');

CREATE TABLE if not exists pollQuestion (
  `pollQueId` BIGINT NOT NULL AUTO_INCREMENT,
  `pollId` BIGINT NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 0,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`pollQueId`),
  foreign key(pollId)references poll(pollId)
);

SELECT * FROM `poll`.`pollQuestion`;

INSERT INTO `poll`.`pollQuestion` (`pollQueId`, `pollId`, `type`, `active`, `createdAt`) VALUES ('1', '1', 'rbhvj', '1', '2022-01-01');
INSERT INTO `poll`.`pollQuestion` (`pollQueId`, `pollId`, `type`, `active`, `createdAt`) VALUES ('2', '2', 'jhfv', '0', '2022-01-25');
INSERT INTO `poll`.`pollQuestion` (`pollQueId`, `pollId`, `type`, `active`, `createdAt`) VALUES ('3', '2', 'yhjgb', '1', '2022-01-25');
INSERT INTO `poll`.`pollQuestion` (`pollQueId`, `pollId`, `type`, `active`, `createdAt`) VALUES ('4', '1', 'yjhvn', '1', '2022-01-01');
INSERT INTO `poll`.`pollQuestion` (`pollQueId`, `pollId`, `type`, `active`, `createdAt`) VALUES ('5', '1', 'yjhvn', '1', '2022-01-01');

CREATE TABLE if not exists pollAnswer (
  `pollAnsId` BIGINT NOT NULL AUTO_INCREMENT,
  `pollId` BIGINT NOT NULL,
  `pollQueId` BIGINT NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 0,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`pollAnsId`),
  foreign key(pollId)references poll(pollId),
  foreign key(pollQueId)references pollQuestion(pollQueId)
);

SELECT * FROM `poll`.`pollAnswer`;

INSERT INTO `poll`.`pollAnswer` (`pollAnsId`, `pollId`, `pollQueId`, `active`, `createdAt`) VALUES ('1', '1', '1', '1', '2022-01-23');
INSERT INTO `poll`.`pollAnswer` (`pollAnsId`, `pollId`, `pollQueId`, `active`, `createdAt`) VALUES ('2', '2', '3', '1', '2022-01-25');

CREATE TABLE if not exists pollVote (
  `pollVoteId` BIGINT NOT NULL AUTO_INCREMENT,
  `pollId` BIGINT NOT NULL,
  `pollQueId` BIGINT NOT NULL,
  `pollAnsId` BIGINT DEFAULT NULL,
  `userId` BIGINT NOT NULL,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL DEFAULT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`pollVoteId`),
  foreign key(pollId)references poll(pollId),
  foreign key(pollQueId)references pollQuestion(pollQueId),
  foreign key(pollAnsId)references pollAnswer(pollAnsId),
  foreign key(userId)references users(userId)
);

SELECT * FROM `poll`.`pollVote`;

INSERT INTO `poll`.`pollVote` (`pollVoteId`, `pollId`, `pollQueId`, `pollAnsId`, `userId`, `createdAt`) VALUES ('1', '1', '1', '1', '1', '2022-01-25');
INSERT INTO `poll`.`pollVote` (`pollVoteId`, `pollId`, `pollQueId`, `pollAnsId`, `userId`, `createdAt`) VALUES ('2', '2', '3', '2', '2', '2022-01-01');

CREATE TABLE if not exists category (
  `catId` BIGINT NOT NULL AUTO_INCREMENT,
  `pollId` BIGINT NULL DEFAULT NULL,
  `title` VARCHAR(75) NOT NULL,
  `metaTitle` VARCHAR(100) NULL DEFAULT NULL,
  `slug` VARCHAR(100) NOT NULL,
  `content` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`catId`),
  foreign key(pollId)references poll(pollId)
);

SELECT * FROM `poll`.`category`;

INSERT INTO `poll`.`category` (`catId`, `pollId`, `title`, `metaTitle`, `slug`) VALUES ('1', '1', 'abc', 'tfdb', 'jmn');
INSERT INTO `poll`.`category` (`catId`, `pollId`, `title`, `metaTitle`, `slug`) VALUES ('2', '2', 'xyz', 'jyhbn', 'jhvbn');

CREATE TABLE if not exists pollCategory (
  `pollId` BIGINT NOT NULL,
  `catId` BIGINT NOT NULL,
  PRIMARY KEY (`pollId`, `catId`),
  foreign key(pollId)references poll(pollId),
  foreign key(catId)references category(catId)
);

SELECT * FROM `poll`.`pollCategory`;

INSERT INTO `poll`.`pollCategory` (`pollId`, `catId`) VALUES ('1', '1');
INSERT INTO `poll`.`pollCategory` (`pollId`, `catId`) VALUES ('2', '2');

CREATE TABLE if not exists tag(
	`tagId` BIGINT NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(75) NOT NULL,
	`metaTitle` VARCHAR(100) NULL DEFAULT NULL,
	`slug` VARCHAR(100) NOT NULL,
	`content` TEXT NULL DEFAULT NULL,
    PRIMARY KEY(tagId)
);

SELECT * FROM `poll`.`tag`;

INSERT INTO `poll`.`tag` (`tagId`, `title`, `metaTitle`, `slug`) VALUES ('1', 'xyz', 'ufkvj', 'JKVNM');
INSERT INTO `poll`.`tag` (`tagId`, `title`, `metaTitle`, `slug`) VALUES ('2', 'abc', 'khjfv', 'jfmvn');

CREATE TABLE if not exists pollTag(
	`pollId` BIGINT NOT NULL,
	`tagId` BIGINT NOT NULL,
	PRIMARY KEY (`pollId`, `tagId`),
	foreign key(pollId)references poll(pollId),
	foreign key(tagId)references tag(tagId)
);

SELECT * FROM `poll`.`pollTag`;

INSERT INTO `poll`.`pollTag` (`pollId`, `tagId`) VALUES ('1', '1');
INSERT INTO `poll`.`pollTag` (`pollId`, `tagId`) VALUES ('2', '1');
