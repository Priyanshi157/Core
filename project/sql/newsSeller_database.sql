CREATE SCHEMA newsletter;
USE newsletter;

CREATE TABLE user
(
	userId INT NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(64),
    middleName VARCHAR(64),
    lastName VARCHAR(64),
    mobileNo VARCHAR(16),
    email VARCHAR(128),
    passwordHash VARCHAR(128) NOT NULL,
    adminNo TINYINT(1) NOT NULL,
    customer TINYINT(1) NOT NULL,
    registeredAt DATETIME NOT NULL,
    lastLogin DATETIME,
    intro TINYTEXT,
    profileInfo TEXT,
    PRIMARY KEY (userId)
);

SELECT * FROM `newsletter`.`user`;

INSERT INTO `newsletter`.`user` (`firstName`, `middleName`, `lastName`, `mobileNo`, `email`, `passwordHash`, `adminNo`, `customer`, 
`registeredAt`, `lastLogin`, `intro`, `profileInfo`) 
VALUES ('Priyanshi', 'Sanjay', 'Jain', '8888888888', 'priyanshi@gmail.com', '11111111', '1', '1', 
'2022-01-01', '2022-01-19', 'priyanshi is here', 'hello!! Priyanshi');

INSERT INTO `newsletter`.`user` (`firstName`, `middleName`, `lastName`, `mobileNo`, `email`, `passwordHash`, `adminNo`, `customer`, 
`registeredAt`, `lastLogin`, `intro`, `profileInfo`) 
VALUES ('Viraj', 'Anil', 'Modhiya', '9999999999', 'viraj@gmail.com', '11111111', '1', '2', 
'2022-01-05', '2022-01-15', 'Viraj is here', 'Hello !! Viraj');

INSERT INTO `newsletter`.`user` (`firstName`, `middleName`, `lastName`, `mobileNo`, `email`, `passwordHash`, `adminNo`, `customer`, 
`registeredAt`, `lastLogin`, `intro`, `profileInfo`) 
VALUES ('Kashish', 'Dilip', 'Mehta', '7777777777', 'kashish@gmail.com', '11111111', '1', '3', 
'2021-12-12', '2022-01-10', 'kashish is here', 'hello!! Kashish');

INSERT INTO `newsletter`.`user` (`firstName`, `middleName`, `lastName`, `mobileNo`, `email`, `passwordHash`, `adminNo`, `customer`, 
`registeredAt`, `lastLogin`, `intro`, `profileInfo`) 
VALUES ('Ruddhi', 'Akshay', 'Talati', '8585858585', 'ruddhi@gmail.com', '11111111', '1', '4', 
'2021-12-31', '2022-01-21', 'ruddhi is here', 'Hello!! Ruddhi');

INSERT INTO `newsletter`.`user` (`firstName`, `middleName`, `lastName`, `mobileNo`, `email`, `passwordHash`, `adminNo`, `customer`, 
`registeredAt`, `lastLogin`, `intro`, `profileInfo`) 
VALUES ('Shreya', 'Mahesh', 'Khandelwal', '9879879875', 'shreya', '11111111', '1', '5', 
'2122-01-15', '2022-01-22', 'shreya is here', 'Hello!! Shreya is here');

INSERT INTO `newsletter`.`user` (`firstName`, `middleName`, `lastName`, `mobileNo`, `email`, `passwordHash`, `adminNo`, 
`customer`, `registeredAt`, `lastLogin`, `intro`, `profileInfo`) 
VALUES ('Shruti', 'Lalit', 'Modi', '9658745698', 'shruti@gmail.com', '11111111', '1', '6', 
'2022--01-17', '2022-01-23', 'shruti is here', 'Hello!! Shruti');

UPDATE `newsletter`.`user` SET `email` = 'shreya@gmail.com', `registeredAt` = '2022-01-15 00:00:00' WHERE (`userId` = '5');

CREATE TABLE newsLetter
(
	newsletterId INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    title VARCHAR(128) NOT NULL,
    descriptionInfo VARCHAR(2048),
    type SMALLINT(8) NOT NULL,
    multiple TINYINT(1) NOT NULL,
    global TINYINT(1) NOT NULL,
    status SMALLINT(6) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    publishedAt DATETIME,
    content TEXT,
    PRIMARY KEY (newsletterId),
    FOREIGN KEY (userId) REFERENCES user(userId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`newsLetter`;

INSERT INTO `newsletter`.`newsLetter` 
(`userId`, `title`, `descriptionInfo`, `type`, `multiple`, `global`, `status`, `createdAt`, `updatedAt`, `publishedAt`) 
VALUES ('1', 'HOST A POLL', ' It’s one of the most fun things to put in a newsletter', '1', '1', '1', '1', '2022-01-01', '2022-01-20', '2022-01-22');

INSERT INTO `newsletter`.`newsLetter` 
(`userId`, `title`, `descriptionInfo`, `type`, `multiple`, `global`, `status`, `createdAt`, `updatedAt`, `publishedAt`) 
VALUES ('2', 'SHARE WHAT YOU HAVE PUBLISHED', ' It’s one of the most fun things to put in a newsletter', '1', '1', '1', '0', '2021-12-25', '2022-01-05', '2022-01-15');

INSERT INTO `newsletter`.`newsLetter` 
(`userId`, `title`, `descriptionInfo`, `type`, `multiple`, `global`, `status`, `createdAt`, `updatedAt`) 
VALUES ('3', 'CONVERSATIONS', ' It’s one of the most fun things to put in a newsletter', '1', '1', '1', '1', '2022-01-15', '2022-01-15');

UPDATE `newsletter`.`newsLetter` SET `newsletterId` = '1' WHERE (`newsletterId` = '7');
UPDATE `newsletter`.`newsLetter` SET `newsletterId` = '2' WHERE (`newsletterId` = '8');
UPDATE `newsletter`.`newsLetter` SET `newsletterId` = '3' WHERE (`newsletterId` = '9');


CREATE TABLE subscriber
(
	subscriberId INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    firstName VARCHAR(64) NOT NULL,
    middleName VARCHAR(64),
    lastName VARCHAR(64),
    emailAddress VARCHAR(128) NOT NULL,
    mobileNO VARCHAR(16),	
    phoneNo VARCHAR(16),
    active TINYINT(1) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    PRIMARY KEY (subscriberId),
    FOREIGN KEY (userId) REFERENCES user(userId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`subscriber`;

INSERT INTO `newsletter`.`subscriber` (`userId`, `firstName`, `emailAddress`, `mobileNO`, `active`, `createdAt`, `updatedAt`) 
VALUES ('1', 'Priyanshi', 'priyanshi@gmail.com', '', '1', '2022-01-01', '2022-01-22');

INSERT INTO `newsletter`.`subscriber` (`userId`, `firstName`, `emailAddress`, `active`, `createdAt`, `updatedAt`) 
VALUES ('3', 'Kashish', 'kashish@gmail.com', '0', '2022-01-05', '2022-01-15');

INSERT INTO `newsletter`.`subscriber` (`userId`, `firstName`, `emailAddress`, `active`, `createdAt`, `updatedAt`) 
VALUES ('2', 'Viraj', 'viraj@gmail.com', '1', '2021-12-12', '2022-01-21');


CREATE TABLE address
(
	addressId INT NOT NULL AUTO_INCREMENT,
    userId INT NOT NULL,
    subscriberId INT NOT NULL,
    firstName VARCHAR(64),
    middleName VARCHAR(64),
    lastName VARCHAR(64),
    mobileNo VARCHAR(64),
    email VARCHAR(128),
    addLine1 VARCHAR(128),
    addLine2 VARCHAR(128),
    city VARCHAR(128),
    province VARCHAR(128),
    country VARCHAR(128),
    areaCode VARCHAR(16),
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    PRIMARY KEY (addressId),
    FOREIGN KEY (userId) REFERENCES user(userId) ON DELETE CASCADE,
    FOREIGN KEY (subscriberId) REFERENCES subscriber(subscriberId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`address`;

INSERT INTO `newsletter`.`address` (`userId`, `subscriberId`, `firstName`, `addLine1`, `addLine2`, `city`, `province`, 
`country`, `areaCode`, `createdAt`) 
VALUES ('1', '1', 'Priyanshi', '302/', 'mg road', 'dahod', 'near xyz store', 'india', '389151', '2022-01-22');

INSERT INTO `newsletter`.`address` (`userId`, `subscriberId`, `firstName`, `addLine1`, `addLine2`, `city`, `province`, 
`country`, `areaCode`, `createdAt`, `updatedAt`) 
VALUES ('2', '2', 'Viraj', '302/', 'mg road', 'dahod', 'near xyz store', 'india', '389151', '2022-01-15', '2022-01-23');

INSERT INTO `newsletter`.`address` (`userId`, `subscriberId`, `firstName`, `addLine1`, `addLine2`, `city`, `province`, 
`country`, `areaCode`, `createdAt`, `updatedAt`) 
VALUES ('3', '3', 'Kashish', '302/', 'mg road', 'dahod', 'near xyz store', 'india', '389151', '2021-12-12', '2022-01-21');

INSERT INTO `newsletter`.`address` (`userId`, `subscriberId`, `firstName`, `addLine1`, `addLine2`, `city`, `province`, 
`country`, `areaCode`, `createdAt`) 
VALUES ('1', '1', 'Priyanshi', '302/', 'mg road', 'dahod', 'near xyz store', 'india', '389151', '2022-01-13');

UPDATE `newsletter`.`address` SET `addressId` = '1' WHERE (`addressId` = '4');
UPDATE `newsletter`.`address` SET `addressId` = '2' WHERE (`addressId` = '5');
UPDATE `newsletter`.`address` SET `addressId` = '3' WHERE (`addressId` = '6');
UPDATE `newsletter`.`address` SET `addressId` = '4' WHERE (`addressId` = '7');


CREATE TABLE newsletterMeta
(
	newsletterMetaId INT NOT NULL AUTO_INCREMENT,
    newsletterId INT NOT NULL,
    type VARCHAR(64) NOT NULL,
    metaKey VARCHAR(128) NOT NULL,
    content TEXT,
    PRIMARY KEY (newsletterMetaId),
    FOREIGN KEY (newsletterId) REFERENCES newsletter(newsletterId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`newsletterMeta`;

INSERT INTO `newsletter`.`newsletterMeta` (`newsletterId`, `type`, `metaKey`) VALUES ('1', 'company', 'uyjhv');
INSERT INTO `newsletter`.`newsletterMeta` (`newsletterId`, `type`, `metaKey`) VALUES ('2', 'consumer', 'fdbsnc');
INSERT INTO `newsletter`.`newsletterMeta` (`newsletterId`, `type`, `metaKey`) VALUES ('1', 'company', 'rgsxv');

UPDATE `newsletter`.`newslettermeta` SET `newsletterMetaId` = '1' WHERE (`newsletterMetaId` = '8');
UPDATE `newsletter`.`newslettermeta` SET `newsletterMetaId` = '2' WHERE (`newsletterMetaId` = '9');
UPDATE `newsletter`.`newslettermeta` SET `newsletterMetaId` = '3' WHERE (`newsletterMetaId` = '10');


CREATE TABLE edition
(
	editionId INT NOT NULL AUTO_INCREMENT,
    newsletterId INT NOT NULL,
    title VARCHAR(128) NOT NULL,
    description VARCHAR(2048),
    status SMALLINT(8) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    publishedAt DATETIME,
    content TEXT,
    PRIMARY KEY (editionId),
    FOREIGN KEY (newsletterId) REFERENCES newsletter(newsletterId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`edition`;

INSERT INTO `newsletter`.`edition` (`newsletterId`, `title`, `description`, `status`, `createdAt`)
VALUES ('1', 'HOPE', 'rshdkjvn', '1', '2022-01-15');

INSERT INTO `newsletter`.`edition` (`newsletterId`, `title`, `description`, `status`, `createdAt`) 
VALUES ('2', 'DREAM', 'wefjk', '0', '2022-01-01');

INSERT INTO `newsletter`.`edition` (`newsletterId`, `title`, `description`, `status`, `createdAt`, `updatedAt`, `publishedAt`) 
VALUES ('3', 'BELIEVE', 'igfvskj iyrghsvb', '1', '2022-01-01', '2022-01-22', '2022-01-24');

CREATE TABLE newsletterTrigger
(
	newsletterTriggerId INT NOT NULL AUTO_INCREMENT,
    newsletterId INT NOT NULL,
    editionId INT NOT NULL,
    subscriberId INT NOT NULL,
    sent TINYINT(1) NOT NULL,
	delivered TINYINT(1) NOT NULL,
    mode SMALLINT(8) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    sentAt DATETIME,
    deliveredAt DATETIME,
    PRIMARY KEY (newsletterTriggerId),
    FOREIGN KEY (newsletterId) REFERENCES newsletter(newsletterId) ON DELETE CASCADE,
    FOREIGN KEY (editionId) REFERENCES edition(editionId) ON DELETE CASCADE,
    FOREIGN KEY (subscriberId) REFERENCES subscriber(subscriberId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`newsletterTrigger`;

INSERT INTO `newsletter`.`newsletterTrigger` (`newsletterId`, `editionId`, `subscriberId`, `sent`, `delivered`, `mode`, `createdAt`) 
VALUES ('1', '1', '1', '1', '1', '1', '2022-01-15');

INSERT INTO `newsletter`.`newsletterTrigger` (`newsletterId`, `editionId`, `subscriberId`, `sent`, `delivered`, `mode`, `createdAt`, `updatedAt`, `sentAt`) 
VALUES ('2', '2', '2', '1', '1', '1', '2022-01-01', '2022-01-20', '2022-01-23');

INSERT INTO `newsletter`.`newsletterTrigger` (`newsletterTriggerId`, `newsletterId`, `editionId`, `subscriberId`, `sent`, `delivered`, 
`mode`, `createdAt`, `updatedAt`, `sentAt`, `deliveredAt`) 
VALUES ('3', '3', '3', '3', '1', '1', '1', '2022-01-01', '2022-01-24', '2022-01-24', '2022-01-24');

CREATE TABLE mailingList
(
	mailingListId INT NOT NULL AUTO_INCREMENT,
    newsletterId INT NOT NULL,
    subscriberId INT NOT NULL,
    active TINYINT(1) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    PRIMARY KEY(mailingListId),
    FOREIGN KEY (newsletterId) REFERENCES newsletter(newsletterId) ON DELETE CASCADE,
	FOREIGN KEY (subscriberId) REFERENCES subscriber(subscriberId) ON DELETE CASCADE
);

SELECT * FROM `newsletter`.`mailingList`;

INSERT INTO `newsletter`.`mailingList` (`newsletterId`, `subscriberId`, `active`, `createdAt`) VALUES ('1', '1', '1', '2022-01-15');
INSERT INTO `newsletter`.`mailingList` (`newsletterId`, `subscriberId`, `active`, `createdAt`) VALUES ('2', '2', '1', '2022-01-01');
INSERT INTO `newsletter`.`mailingList` (`newsletterId`, `subscriberId`, `active`, `createdAt`) VALUES ('3', '3', '0', '2022-01-22');



/* query 1 : Get all the users who created in the last 15 days. */
SELECT * FROM `newsletter`.`user`
       WHERE registeredAt> now() - INTERVAL 15 day;

/* query 2 : Get all the users with their addresses who are active subscribers. */
SELECT us.userId, us.firstName , us.middleName , us.lastName , ad.addLine1 , ad.addLine2 ,ad.city,ad.province,ad.country, ad.areaCode , sub.active 
FROM  `newsletter`.`user` AS us , `newsletter`.`address` AS ad ,
`newsletter`.`subscriber` AS sub  WHERE  us.userId =  ad.userId = sub.userId AND sub.active = '1';

/* query 3 : Get all the users who subscribed in the last 30 days and are active currently. */
SELECT * FROM `newsletter`.`user`
JOIN `newsletter`.`subscriber` ON user.userId = subscriber.userId 
WHERE createdAT > now() - INTERVAL 30 day AND active = '1';

/* query 4 : Get all the users email who are currently in the active mailing list. */
SELECT emailAddress FROM `newsletter`.`subscriber`
JOIN `newsletter`.`mailinglist` ON subscriber.subscriberId = mailingList.subscriberId
WHERE mailingList.active = '1';

/* query 5 : Get all the users email and newsletter title for which newsletter triggered today. */
SELECT * FROM `newsletter`.`newsletterTrigger` 
WHERE cast(sentAt AS DATE) = cast(CURRENT_DATE() AS DATE);