CREATE SCHEMA emp;
USE emp;

CREATE TABLE permission (
    permissionId BIGINT(16) NOT NULL AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL,
    slug VARCHAR(128) NOT NULL,
    description TINYTEXT,
    type SMALLINT(8) NOT NULL,
    active SMALLINT(8) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    content TEXT,
    PRIMARY KEY(permissionId)
);

SELECT * FROM `emp`.`permission`;

INSERT INTO `emp`.`permission` (`permissionId`, `title`, `slug`, `description`, `type`, `active`, `createdAt`) 
VALUES ('1', 'hope', 'hope', '', '1', '1', '2022-01-21');

INSERT INTO `emp`.`permission` (`permissionId`, `title`, `slug`, `type`, `active`, `createdAt`, `updatedAt`)
VALUES ('2', 'dream', 'dream', '2', '0', '2022-01-01', '2022-01-23');
 
INSERT INTO `emp`.`permission` (`permissionId`, `title`, `slug`, `type`, `active`, `createdAt`) 
VALUES ('3', 'little things', 'little things', '3', '1', '2022-01-01');


CREATE TABLE rolePermission (
    roleId BIGINT(16) NOT NULL AUTO_INCREMENT,
    permissionId BIGINT(16) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    PRIMARY KEY(roleId),
    FOREIGN KEY(permissionId) REFERENCES permission(permissionId)
);

SELECT * FROM `emp`.`rolePermission`;

INSERT INTO `emp`.`rolePermission` (`roleId`, `permissionId`, `createdAt`) VALUES ('1', '1', '2022-01-24');
INSERT INTO `emp`.`rolePermission` (`roleId`, `permissionId`, `createdAt`) VALUES ('2', '2', '2022-01-01');
INSERT INTO `emp`.`rolePermission` (`roleId`, `permissionId`, `createdAt`) VALUES ('3', '3', '2022-01-22');

CREATE TABLE role (
    roleId BIGINT(16) NOT NULL AUTO_INCREMENT,
    title VARCHAR(64) NOT NULL,
    slug VARCHAR(128) NOT NULL,
    description TINYTEXT,
    type SMALLINT(8) NOT NULL,
    active SMALLINT(8) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    content TEXT,
    PRIMARY KEY(roleId)
);

SELECT * FROM `emp`.`role`;

INSERT INTO `emp`.`role` (`roleId`, `title`, `slug`, `type`, `active`, `createdAt`) 
VALUES ('1', 'staff', 'sdgvet', '1', '1', '2021-12-01');

INSERT INTO `emp`.`role` (`roleId`, `title`, `slug`, `type`, `active`, `createdAt`) 
VALUES ('2', 'sotware engineer', 'jhbfvhkjc', '2', '1', '2022-01-01');

INSERT INTO `emp`.`role` (`roleId`, `title`, `slug`, `type`, `active`, `createdAt`, `updatedAt`) 
VALUES ('3', 'software engineer', 'tyfghj', '2', '0', '2021-05-28', '2021-12-12');

INSERT INTO `emp`.`role` (`roleId`, `title`, `slug`, `type`, `active`, `createdAt`) 
VALUES ('4', 'junior developer', 'yuvjuhkjn', '3', '1', '2022-01-22');

UPDATE `emp`.`role` SET `title` = 'senior software engineer' WHERE (`roleId` = '3');

CREATE TABLE user (
    userId BIGINT(16) NOT NULL AUTO_INCREMENT,
    roleId BIGINT(16) NOT NULL,
    firstName VARCHAR(64),
    middleName VARCHAR(64),
    lastName VARCHAR(64),
    mobile VARCHAR(16),
    email VARCHAR(64),
    passwordHash VARCHAR(128) NOT NULL,
    registeredAt DATETIME NOT NULL,
    lastLogin DATETIME,
    intro TINYTEXT,
    profile TEXT,
    PRIMARY KEY(userId),
    FOREIGN KEY(roleId) REFERENCES role(roleId)
);

SELECT * FROM `emp`.`user`;

INSERT INTO `emp`.`user` (`userId`, `roleId`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `passwordHash`, `registeredAt`, `lastLogin`) 
VALUES ('1', '1', 'Priyanshi', 'Sanjay', 'Jain', '8989989889', 'priyanshi@gmail.com', '11111111', '2021-12-12', '2022-01-22');

INSERT INTO `emp`.`user` (`userId`, `roleId`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `passwordHash`, `registeredAt`) 
VALUES ('2', '2', 'Viraj', 'Anil', 'modhiya', '9876549874', 'viraj@gmail.com', '11111111', '2022-01-01');

INSERT INTO `emp`.`user` (`userId`, `roleId`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `passwordHash`, `registeredAt`) 
VALUES ('3', '2', 'Kashish', 'Dilip', 'Mehta', '7894561235', 'kashish@gmail.com', '11111111', '2021-12-12');

INSERT INTO `emp`.`user` (`userId`, `roleId`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `passwordHash`, `registeredAt`) 
VALUES ('4', '3', 'Ruddhi', 'Akshay', 'Talati', '9800125478', 'ruddhi@gmail.com', '11111111', '2022-01-20');

INSERT INTO `emp`.`user` (`userId`, `roleId`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `passwordHash`, `registeredAt`, `lastLogin`) 
VALUES ('5', '4', 'Prayas', 'Sanjay', 'Jain', '8745210325', 'prayas@gmail.com', '11111111', '2022-01-13', '2022-01-24');

CREATE TABLE organization (
	organizationId BIGINT(24) NOT NULL AUTO_INCREMENT,
    createdBy BIGINT(64) NOT NULL,
    updatedBy BIGINT(64) NOT NULL,
    title VARCHAR(64) NOT NULL,
    metaTitle VARCHAR(128),
    slug VARCHAR(128) NOT NULL,
    summary TINYTEXT,
    status SMALLINT(8) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    profile TEXT,
    content TEXT,
    PRIMARY KEY(organizationId),
    FOREIGN KEY (createdBy) REFERENCES user(userId),
    FOREIGN KEY(updatedby) REFERENCES user(userId)
);

SELECT * FROM `emp`.`organization`;

INSERT INTO `emp`.`organization` (`createdBy`, `updatedBy`, `title`, `metaTitle`, `slug`, `summary`, `status`, `createdAt`, `updatedAt`, `content`) VALUES ('1', '1', 'og1', 'og1', 'og1', 'og1', '1', '2022-01-23', '2022-01-23', 'og1 content');
INSERT INTO `emp`.`organization` ( `createdBy`, `updatedBy`, `title`, `metaTitle`, `slug`, `summary`, `status`, `createdAt`, `updatedAt`, `content`) VALUES ( '2', '2', 'og2', 'og2', 'og2', 'og2', '0', '2022-01-22', '2022-01-22', 'og2  content');
INSERT INTO `emp`.`organization` (`createdBy`, `updatedBy`, `title`, `metaTitle`, `slug`, `summary`, `status`, `createdAt`, `updatedAt`, `content`) VALUES ('1', '2', 'og3', 'og3', 'og3', 'og3', '1', '2022-01-24', '2022-01-24', 'og3 content');

CREATE TABLE organizationMeta (
    metaId BIGINT(24) NOT NULL AUTO_INCREMENT,
    organizationId BIGINT(16) NOT NULL,
    key1 VARCHAR(64) NOT NULL,
    content TEXT,
    PRIMARY KEY(metaId),
    FOREIGN KEY(organizationId) REFERENCES organization(organizationId)
);

CREATE TABLE employee (
    employeeId BIGINT(16) NOT NULL AUTO_INCREMENT,
    userId BIGINT(16) NOT NULL,
    organizationId BIGINT(24) NOT NULL,
    roleId BIGINT(24) NOT NULL,
    createdBy BIGINT(24) NOT NULL,
    updatedBy BIGINT(24) NOT NULL,
    code VARCHAR(104) NOT NULL,
    status SMALLINT(8) NOT NULL,
    createdAt DATETIME NOT NULL,
    updatedAt DATETIME,
    startsAt DATETIME,
    endsAt DATETIME,
    notes TEXT,
    PRIMARY KEY(employeeId),
    FOREIGN KEY(userId) REFERENCES user(userId),
    FOREIGN KEY(organizationId) REFERENCES organization(organizationId),
    FOREIGN KEY(roleId) REFERENCES role(roleId),
    FOREIGN KEY(createdBy) REFERENCES user(userid),
    FOREIGN KEY(updatedBy) REFERENCES user(userId)
);

INSERT INTO `emp`.`employee` (`userId`, `organizationId`, `roleId`, `createdBy`, `updatedBy`, `code`, `status`, `createdAt`, 
`updatedAt`, `startsAt`, `endsAt`, `notes`) 
VALUES ('1', '3', '1', '1', '1', '1', '1', '2022-01-23', '2022-01-23', '2022-01-23', '2022-02-27', 'Notes');

INSERT INTO `emp`.`employee` (`userId`, `organizationId`, `roleId`, `createdBy`, `updatedBy`, `code`, `status`, `createdAt`, 
`updatedAt`, `startsAt`, `endsAt`, `notes`) 
VALUES ('2', '1', '2', '1', '1', '1', '0', '2022-01-23', '2022-01-23', '2022-01-23', '2022-02-27', 'Notes');

INSERT INTO `emp`.`employee` (`userId`, `organizationId`, `roleId`, `createdBy`, `updatedBy`, `code`, `status`, `createdAt`, 
`updatedAt`, `startsAt`, `endsAt`, `notes`) 
VALUES ('3', '2', '3', '1', '1', '1', '1', '2022-01-23', '2022-01-23', '2022-01-23', '2022-02-27', 'Notes');

INSERT INTO `emp`.`employee` (`userId`, `organizationId`, `roleId`, `createdBy`, `updatedBy`, `code`, `status`, `createdAt`, 
`updatedAt`, `startsAt`, `endsAt`, `notes`) 
VALUES ('4', '3', '4', '1', '1', '1', '0', '2022-01-23', '2022-01-23', '2022-01-23', '2022-02-27', 'Notes');

INSERT INTO `emp`.`employee` (`userId`, `organizationId`, `roleId`, `createdBy`, `updatedBy`, `code`, `status`, `createdAt`, 
`updatedAt`, `startsAt`, `endsAt`, `notes`) 
VALUES ('5', '2', '1', '1', '1', '1', '1', '2022-01-23', '2022-01-23', '2022-01-23', '2022-02-27', 'Notes');

/*Get the users which are having permission id assigned as 2.*/
SELECT * FROM `emp`.`user` AS us INNER JOIN `emp`.`rolePermission` AS rp WHERE us.roleId = rp.roleId AND rp.permissionId = 2;

/*Get a list of users who are working in organization id 1 along with organization title..*/
SELECT * FROM `emp`.`user` AS us INNER JOIN `emp`.`employee` AS ep WHERE us.userId = ep.userId AND ep.organizationId =3 ;

/*Get all the employee emails who are created in the last two dates and have permission id 1.*/
SELECT us.email FROM `emp`.`user` AS us , `emp`.`employee` AS ep ,`emp`.`rolePermission` AS rp  WHERE us.userId = ep.userId  AND day(ep.createdAt) > 20 AND us.roleId = rp.roleId AND rp.permissionId = 2 ; 

/*Get the active count of employees working in organization id 1.*/
SELECT COUNT(*) FROM `emp`.`employee` WHERE status = 1 AND organizationId = 3;

/*Get all the employee emails who were working last year.*/
SELECT us.email FROM `emp`.`user` AS us INNER JOIN `emp`.`employee` AS ep 
WHERE us.userId = ep.userId  AND year(ep.startsAt) = year(ep.endsAt) = 2021; 
/* YEAR(employee.createdAt) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)); */