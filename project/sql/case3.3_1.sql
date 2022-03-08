CREATE SCHEMA IF NOT EXISTS restaurant;

CREATE TABLE IF NOT EXISTS `restaurant`.`user`(
	`userId` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(64),
    `middleName` VARCHAR(64),
    `lastName` VARCHAR(64),
    `mobile` VARCHAR(16),
    `email` VARCHAR(64),
    `passwordHash` VARCHAR(32),
    `admin` TINYINT NOT NULL,
    `vendor` TINYINT NOT NULL,
    `registeredAt` DATETIME NOT NULL,
    `lastLogin` DATETIME,
    `intro` TINYTEXT,
    `profile` TEXT,
    PRIMARY KEY(`userId`)
);

SELECT * FROM `restaurant`.`user`;

INSERT INTO `restaurant`.`user` (`userId`, `firstName`, `lastName`, `mobile`, `email`, `passwordHash`, `admin`, `vendor`, `registeredAt`, `lastLogin`) 
VALUES ('1', 'priyanshi', 'lunawat', '9874561020', 'priyanshi@gmail.com', '11111111', '1', '1', '2021-12-12', '2022-01-23');
INSERT INTO `restaurant`.`user` (`userId`, `firstName`, `lastName`, `mobile`, `email`, `passwordHash`, `admin`, `vendor`, `registeredAt`, `lastLogin`) 
VALUES ('2', 'kwinsi', 'sadhu', '8974561025', 'kwinsi@gmail.com', '11111111', '1', '2', '2021-05-25', '2022-01-01');
INSERT INTO `restaurant`.`user` (`userId`, `firstName`, `lastName`, `mobile`, `email`, `passwordHash`, `admin`, `vendor`, `registeredAt`) 
VALUES ('3', 'darpan', 'vadher', '7894585486', 'darpan@gmail.com', '11111111', '1', '1', '2022-01-01');
INSERT INTO `restaurant`.`user` (`userId`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `passwordHash`, `admin`, `vendor`, `registeredAt`) 
VALUES ('4', 'drashti', 'anilkumar', 'patel', '9874569858', 'drashti@gmail.com', '11111111', '1', '2', '2022-01-25');

CREATE TABLE IF NOT EXISTS `restaurant`.`menu` (
  `menuId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userId` BIGINT(20) NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `summary` VARCHAR(128) NOT NULL,
  `type` SMALLINT(6) NOT NULL,
  `craetedAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`menuId`),
  FOREIGN KEY (`userId`) REFERENCES `restaurant`.`user`(`userId`)
);

SELECT * FROM `restaurant`.`menu`;

INSERT INTO `restaurant`.`menu` (`menuId`, `userId`, `title`, `summary`, `type`, `craetedAt`) 
VALUES ('1', '1', 'starter', 'starter', '1', '2022-01-01');
INSERT INTO `restaurant`.`menu` (`menuId`, `userId`, `title`, `summary`, `type`, `craetedAt`) 
VALUES ('2', '2', 'main course', 'main course', '2', '2022-01-04');
INSERT INTO `restaurant`.`menu` (`menuId`, `userId`, `title`, `summary`, `type`, `craetedAt`) 
VALUES ('3', '1', 'main course', 'main course', '2', '2022-01-02');
INSERT INTO `restaurant`.`menu` (`menuId`, `userId`, `title`, `summary`, `type`, `craetedAt`) 
VALUES ('4', '3', 'dessert', 'dessert', '3', '2022-01-08');

CREATE TABLE IF NOT EXISTS `restaurant`.`item` (
  `itemId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userId` BIGINT(20) NOT NULL,
  `vendorId` BIGINT(20) NOT NULL,
  `title` VARCHAR(64) NOT NULL,
  `slug` VARCHAR(64) NOT NULL,
  `summary` VARCHAR(128) NOT NULL,
  `type` SMALLINT(6) NOT NULL,
  `cooking` TINYINT(1) NOT NULL,
  `sku` VARCHAR(128) NOT NULL,
  `price` FLOAT NOT NULL,
  `quantity` FLOAT NOT NULL,
  `unit` SMALLINT(6) NOT NULL,
  `recipe` TEXT NULL,
  `intruction` TEXT NULL,
  `craetedAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`itemId`),
  FOREIGN KEY (`userId`) REFERENCES `restaurant`.`user`(`userId`)
);

SELECT * FROM `restaurant`.`item`;

INSERT INTO `restaurant`.`item` (`itemId`, `userId`, `vendorId`, `title`, `slug`, `summary`, `type`, `cooking`, `sku`, 
`price`, `quantity`, `unit`, `craetedAt`) 
VALUES ('1', '1', '1', 'paneer chilli', 'paneerchilli', 'paneer chilli', '1', '1', 'paneer chilli', '250', '1', '1', '2022-01-01');

INSERT INTO `restaurant`.`item` (`itemId`, `userId`, `vendorId`, `title`, `slug`, `summary`, `type`, `cooking`, `sku`, 
`price`, `quantity`, `unit`, `craetedAt`) 
VALUES ('2', '1', '1', 'cheese masala', 'cheese masala', 'cheese masala', '2', '2', 'cheese masala', '300', '1', '1', '2022-01-15');

INSERT INTO `restaurant`.`item` (`itemId`, `userId`, `vendorId`, `title`, `slug`, `summary`, `type`, `cooking`, `sku`, 
`price`, `quantity`, `unit`, `craetedAt`) 
VALUES ('3', '2', '2', 'manchurian', 'manchurian', 'mancurian', '1', '1', 'manchurian', '200', '1', '1', '2022-01-05');

CREATE TABLE IF NOT EXISTS `restaurant`.`menuItem` (
  `menuItemId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `menuId` BIGINT(20) NOT NULL,
  `itemId` BIGINT(20) NOT NULL,
  PRIMARY KEY (`menuItemId`),
  FOREIGN KEY (`menuId`) REFERENCES `restaurant`.`menu`(`menuId`),
  FOREIGN KEY (`itemId`) REFERENCES `restaurant`.`item`(`itemId`)
);

SELECT * FROM `restaurant`.`menuItem`;

INSERT INTO `restaurant`.`menuItem` (`menuItemId`, `menuId`, `itemId`) VALUES ('1', '1', '1');
INSERT INTO `restaurant`.`menuItem` (`menuItemId`, `menuId`, `itemId`) VALUES ('2', '2', '2');
INSERT INTO `restaurant`.`menuItem` (`menuItemId`, `menuId`, `itemId`) VALUES ('3', '1', '2');

CREATE TABLE IF NOT EXISTS `restaurant`.`ingredients`(
	`ingredientid` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `userId` BIGINT(20) NOT NULL,
    `vendor` BIGINT(20),
    `slug` VARCHAR(128) NOT NULL,
    `summary` TINYTEXT,
    `type` SMALLINT(8) NOT NULL,
    `sku` VARCHAR(128) NOT NULL,
    `quantity` FLOAT NOT NULL,
    `unit` SMALLINT(8) NOT NULL,
    `createdAt` DATETIME NOT NULL,
    `updatedAt` DATETIME,
    `content` TEXT,
    PRIMARY KEY(`ingredientId`),
    FOREIGN KEY(`userId`) REFERENCES `restaurant`.`user`(`userId`),
    FOREIGN KEY(`vendor`) REFERENCES `restaurant`.`user`(`userId`)
);

SELECT * FROM `restaurant`.`ingredients`;

INSERT INTO `restaurant`.`ingredients` (`ingredientid`, `userId`, `vendor`, `slug`, `summary`, `type`, `sku`, `quantity`, `unit`, `createdAt`) 
VALUES ('1', '1', '1', 'vbhrkfm', 'iufkhvcj', '1', 'rkgv', '2', '2', '2022-01-01');
INSERT INTO `restaurant`.`ingredients` (`ingredientid`, `userId`, `vendor`, `slug`, `summary`, `type`, `sku`, `quantity`, `unit`, `createdAt`) 
VALUES ('2', '2', '2', 'gkjlvn', 'rgdkvjn', '2', 'rvujk', '2', '3', '2022-01-12');
INSERT INTO `restaurant`.`ingredients` (`ingredientid`, `userId`, `vendor`, `slug`, `summary`, `type`, `sku`, `quantity`, `unit`, `createdAt`) 
VALUES ('3', '2', '1', 'fdkbgvk', 'khfbgvkfj', '3', 'fhbgkj', '4', '1', '2022-01-10');

CREATE TABLE IF NOT EXISTS `restaurant`.`itemChef` (
  `itemChefId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `itemId` BIGINT(20) NOT NULL,
  `chefId` BIGINT(20) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  PRIMARY KEY (`itemChefId`),
  FOREIGN KEY (`itemId`) REFERENCES `restaurant`.`item`(`itemId`),
  FOREIGN KEY (`chefId`) REFERENCES `restaurant`.`user`(`userId`)
);

SELECT * FROM `restaurant`.`itemChef`;

INSERT INTO `restaurant`.`itemChef` (`itemChefId`, `itemId`, `chefId`, `active`) VALUES ('1', '1', '1', '1');
INSERT INTO `restaurant`.`itemChef` (`itemChefId`, `itemId`, `chefId`, `active`) VALUES ('2', '2', '1', '1');
INSERT INTO `restaurant`.`itemChef` (`itemChefId`, `itemId`, `chefId`, `active`) VALUES ('3', '1', '2', '0');

CREATE TABLE IF NOT EXISTS `restaurant`.`recipe` (
  `recipeId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `itemId` BIGINT(20) NOT NULL,
  `ingredientid` BIGINT(20) NOT NULL,
  `quantity` FLOAT NOT NULL,
  `unit` SMALLINT(6) NOT NULL,
  `intruction` TEXT NULL,
  PRIMARY KEY (`recipeId`),
  FOREIGN KEY (`itemId`) REFERENCES `restaurant`.`item`(`itemId`),
  FOREIGN KEY (`ingredientid`) REFERENCES `restaurant`.`ingredients`(`ingredientid`)
);

SELECT * FROM `restaurant`.`recipe`;

INSERT INTO `restaurant`.`recipe` (`recipeId`, `itemId`, `ingredientid`, `quantity`, `unit`) VALUES ('1', '1', '1', '1', '1');
INSERT INTO `restaurant`.`recipe` (`recipeId`, `itemId`, `ingredientid`, `quantity`, `unit`) VALUES ('2', '2', '2', '2', '2');
INSERT INTO `restaurant`.`recipe` (`recipeId`, `itemId`, `ingredientid`, `quantity`, `unit`) VALUES ('3', '3', '3', '4', '1');

CREATE TABLE IF NOT EXISTS `restaurant`.`tableTop` (
  `tableTopId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(104) NOT NULL,
  `capacity` SMALLINT(6) NOT NULL,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME,
  `content` TEXT, 
  PRIMARY KEY (`tableTopId`)
);

SELECT * FROM `restaurant`.`tableTop`;

INSERT INTO `restaurant`.`tableTop` (`tableTopId`, `code`, `capacity`, `createdAt`) VALUES ('1', 'table001', '4', '2022-01-01');
INSERT INTO `restaurant`.`tableTop` (`tableTopId`, `code`, `capacity`, `createdAt`) VALUES ('2', 'table002', '2', '2022-01-01');
INSERT INTO `restaurant`.`tableTop` (`tableTopId`, `code`, `capacity`, `createdAt`) VALUES ('3', 'table003', '10', '2022-01-15');
INSERT INTO `restaurant`.`tableTop` (`tableTopId`, `code`, `capacity`, `createdAt`) VALUES ('4', 'table004', '4', '2022-01-01');

CREATE TABLE IF NOT EXISTS `restaurant`.`order` (
  `orderId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userId` BIGINT(20) NOT NULL,
  `vendorId` BIGINT(20) NOT NULL,
  `token` VARCHAR(108) NOT NULL,
  `status` SMALLINT(6) NOT NULL,
  `subTotal` FLOAT NOT NULL,
  `itemDiscount` FLOAT NOT NULL,
  `tax` FLOAT NOT NULL,
  `shipping` FLOAT NOT NULL,
  `total` FLOAT NOT NULL,
  `promo` VARCHAR(64) NOT NULL,
  `discount` FLOAT NOT NULL,
  `grandTotal` FLOAT NOT NULL,
  `firstName` VARCHAR(64),
  `middleName` VARCHAR(64),
  `lastName` VARCHAR(64),
  `mobile` VARCHAR(16),
  `email` VARCHAR(64),
  `line1` VARCHAR(64),
  `line2` VARCHAR(64),
  `city` VARCHAR(64),
  `province` VARCHAR(16),
  `country` VARCHAR(64),
  `craetedAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`userId`) REFERENCES `restaurant`.`user`(`userId`),
  FOREIGN KEY (`vendorId`) REFERENCES `restaurant`.`user`(`userId`)
);

SELECT * from `restaurant`.`order`;

INSERT INTO `restaurant`.`order` (`orderId`, `userId`, `vendorId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, `total`, 
`promo`, `discount`, `grandTotal`, `firstName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, `province`, `country`, `craetedAt`) 
VALUES ('1', '1', '1', 'rjfn', '1', '500', '100', '50', '50', '500', 'SUPER100', '100', '500', 'priyanshi', 'lunawat', '9974561235', 
'priyanshi@gmail.com', '320/', 'mgroad', 'dahod', 'near xyz store', 'india', '2022-01-05');

INSERT INTO `restaurant`.`order` (`orderId`, `userId`, `vendorId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, `total`, 
`promo`, `discount`, `grandTotal`, `firstName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, `province`, `country`, `craetedAt`) 
VALUES ('2', '2', '2', 'gv', '1', '1000', '0', '0', '0', '1000', 'NODISCOUNT', '0', '1000', 'kwinsi', 'sadhu', '8745698541', 
'kwinsi@gmail.com', '320/', 'mgroad', 'dahod', 'near xyz store', 'india', '2022-01-17');

INSERT INTO `restaurant`.`order` (`orderId`, `userId`, `vendorId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, `total`, 
`promo`, `discount`, `grandTotal`, `firstName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, `province`, `country`, `craetedAt`) 
VALUES ('3', '1', '2', 'gv', '1', '1000', '0', '0', '0', '700', 'DISCOUNT10', '70', '630', 'drashti', 'patel', '8745698541', 
'drashti@gmail.com', '320/', 'mgroad', 'dahod', 'near xyz store', 'india', '2022-01-17 08:00:00');

INSERT INTO `restaurant`.`order` (`orderId`, `userId`, `vendorId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, `total`, 
`promo`, `discount`, `grandTotal`, `firstName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, `province`, `country`, `craetedAt`) 
VALUES ('4', '1', '2', 'gv', '1', '1000', '0', '0', '0', '700', 'DISCOUNT10', '70', '630', 'drashti', 'patel', '8745698541', 
'drashti@gmail.com', '320/', 'mgroad', 'dahod', 'near xyz store', 'india', '2022-01-17 09:00:00');


CREATE TABLE IF NOT EXISTS `restaurant`.`orderItem` (
  `orderItemId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `orderId` BIGINT(20) NOT NULL,
  `itemId` BIGINT(20) NOT NULL,
  `sku` VARCHAR(108) NOT NULL,
  `price` FLOAT NOT NULL,
  `discount` FLOAT NOT NULL,
  `quantity` FLOAT NOT NULL,
  `unit` SMALLINT(6) NOT NULL,
  `craetedAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`orderItemId`),
  FOREIGN KEY (`itemId`) REFERENCES `restaurant`.`item`(`itemId`),
  FOREIGN KEY (`orderId`) REFERENCES `restaurant`.`order`(`orderId`)
);

SELECT * FROM `restaurant`.`orderItem`;

INSERT INTO `restaurant`.`orderItem` (`orderItemId`, `orderId`, `itemId`, `sku`, `price`, `discount`, `quantity`, `unit`, `craetedAt`) 
VALUES ('1', '1', '1', 'fkujvn', '500', '100', '1', '1', '2022-01-01');

INSERT INTO `restaurant`.`orderItem` (`orderItemId`, `orderId`, `itemId`, `sku`, `price`, `discount`, `quantity`, `unit`, `craetedAt`) 
VALUES ('2', '2', '2', 'jfmnv', '1000', '0', '1', '1', '2022-01-17');

CREATE TABLE IF NOT EXISTS `restaurant`.`booking` (
  `bookingId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `tableId` BIGINT(20),
  `userId` BIGINT(20),
  `token` VARCHAR(128) NOT NULL,
  `status` SMALLINT(8) NOT NULL,
  `firstName` VARCHAR(64),
  `middleName` VARCHAR(64),
  `lastName` VARCHAR(64),
  `mobile` VARCHAR(16),
  `email` VARCHAR(64),
  `line1` VARCHAR(64),
  `line2` VARCHAR(64),
  `city` VARCHAR(64),
  `province` VARCHAR(64),
  `country` VARCHAR(64),
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME,
  `content` TEXT,
  PRIMARY KEY (`bookingId`),
  FOREIGN KEY (`tableId`) REFERENCES `restaurant`.`tabletop` (`tableTopId`),
  FOREIGN KEY (`userId`) REFERENCES `restaurant`.`user` (`userId`)
);

SELECT * FROM `restaurant`.`booking`;

INSERT INTO `restaurant`.`booking` (`bookingId`, `tableId`, `userId`, `token`, `status`, `firstName`, `lastName`, `mobile`, `email`, 
`line1`, `line2`, `city`, `province`, `country`, `createdAt`) 
VALUES ('1', '1', '1', 'gbf', '1', 'priyanshi', 'lunawat', '9874561254', 'priyanshi@gmail.com', 
'302/', 'mgroad', 'dahod', 'near xyzstore', 'india', '2022-01-01');

INSERT INTO `restaurant`.`booking` (`bookingId`, `tableId`, `userId`, `token`, `status`, `firstName`, `lastName`, `mobile`, `email`, 
`line1`, `line2`, `city`, `province`, `country`, `createdAt`) 
VALUES ('2', '2', '2', 'hfbvn', '0', 'kwinsi', 'sadhu', '8974560215', 'kwinsi', 
'302/', 'mgroad', 'dahod', 'near xyz store', 'india', '2022-01-17');

CREATE TABLE IF NOT EXISTS `restaurant`.`bookingItem` (
  `bookingItemId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `bookingId` BIGINT(20) NOT NULL,
  `itemId` BIGINT(20) NOT NULL,
  `sku` VARCHAR(108) NOT NULL,
  `price` FLOAT NOT NULL,
  `discount` FLOAT NOT NULL,
  `quantity` FLOAT NOT NULL,
  `unit` SMALLINT(6) NOT NULL,
  `status` SMALLINT(8) NOT NULL,
  `craetedAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`bookingItemId`),
  FOREIGN KEY (`bookingId`) REFERENCES `restaurant`.`booking`(`bookingId`),
  FOREIGN KEY (`itemId`) REFERENCES `restaurant`.`item`(`itemId`)
);

SELECT * FROM `restaurant`.`bookingItem`;

INSERT INTO `restaurant`.`bookingItem` (`bookingItemId`, `bookingId`, `itemId`, `sku`, `price`, `discount`, `quantity`, `unit`, `status`, `craetedAt`) 
VALUES ('1', '1', '1', 'kjvn', '500', '100', '1', '1', '1', '2022-01-01');
INSERT INTO `restaurant`.`bookingItem` (`bookingItemId`, `bookingId`, `itemId`, `sku`, `price`, `discount`, `quantity`, `unit`, `status`, `craetedAt`) 
VALUES ('2', '2', '2', 'ukhj', '1000', '0', '1', '1', '1', '2022-01-17');


CREATE TABLE IF NOT EXISTS `restaurant`.`transection` (
  `transectionId` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `userId` BIGINT(20) NOT NULL,
  `vendorId` BIGINT(20) NOT NULL,
  `orderId` BIGINT(20) NOT NULL,
  `code` VARCHAR(108) NOT NULL,
  `type` SMALLINT(6) NOT NULL,
  `mode` SMALLINT(8) NOT NULL,
  `status` SMALLINT(8) NOT NULL,
  `craetedAt` DATETIME NOT NULL,
  `updatedAt` DATETIME NULL,
  `content` TEXT NULL,
  PRIMARY KEY (`transectionId`),
  FOREIGN KEY (`userId`) REFERENCES `restaurant`.`user`(`userId`),
  FOREIGN KEY (`vendorId`) REFERENCES `restaurant`.`user`(`userId`),
  FOREIGN KEY (`orderId`) REFERENCES `restaurant`.`order`(`orderId`)
);

SELECT * FROM `restaurant`.`transection`;

INSERT INTO `restaurant`.`transection` (`transectionId`, `userId`, `vendorId`, `orderId`, `code`, `type`, `mode`, `status`, `craetedAt`) 
VALUES ('1', '1', '1', '1', 'jhvb', '1', '1', '1', '2022-01-01');
INSERT INTO `restaurant`.`transection` (`transectionId`, `userId`, `vendorId`, `orderId`, `code`, `type`, `mode`, `status`, `craetedAt`) 
VALUES ('2', '2', '2', '2', 'hvj', '2', '1', '0', '2022-01-17');
