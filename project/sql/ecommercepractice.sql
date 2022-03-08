CREATE SCHEMA `eCommercePractice`;

CREATE TABLE `eCommercePractice`.`category`(
	`categoryId` BIGINT(24) NOT NULL,
    `parentId` BIGINT(24),
    `title` VARCHAR(104) NOT NULL,
    `metaTitle` VARCHAR(104),
    `content` TEXT,
    PRIMARY KEY(`categoryId`)
);
        
CREATE TABLE `eCommercePractice`.`user`(
	`userId` BIGINT(24) NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(64),
    `middleName` VARCHAR(64),
    `lastName` VARCHAR(64),
    `mobile` VARCHAR(64),
    `email` VARCHAR(64),
    `passwordHash` VARCHAR(32) NOT NULL,
    `admin` TINYINT(1),
    `vendor` TINYINT(1),
    `registeredAt` DATETIME NOT NULL,
    `lastLogin` DATETIME,
    `intro` TINYTEXT,
    `profile` TEXT,
    PRIMARY KEY(userId)
);
    
CREATE TABLE `eCommercePractice`.`product`(
	`productId` BIGINT(24) NOT NULL AUTO_INCREMENT,
    `userId` BIGINT(24) NOT NULL,
    `title` VARCHAR(64) NOT NULL,
    `metaTUitle` VARCHAR(104),
    `slug` VARCHAR(104) NOT NULL,
    `summary` TINYTEXT,
    `type` SMALLINT(8) NOT NULL,
    `sku` VARCHAR(104) NOT NULL,
    `price` FLOAT NOT NULL,
    `discount` FLOAT NOT NULL,
    `quantity` SMALLINT(8) NOT NULL,
    `shop` TINYINT(1) NOT NULL,
    `createdAt` DATETIME NOT NULL,
    `updatedAt` DATETIME,
    `publishedAt` DATETIME,
    `startAt` DATETIME,
    `endsAt` DATETIME,
    `content` TEXT,
    PRIMARY KEY(productId)
);

ALTER TABLE   `eCommercePractice`.`product` DROP COLUMN `slug`;
ALTER TABLE   `eCommercePractice`.`product` DROP COLUMN `userId`; 

CREATE TABLE `eCommercePractice`.`productCategory`(
	`productId` BIGINT(24) NOT NULL,
    `categoryId` BIGINT(24) NOT NULL,
    FOREIGN KEY(categoryId) REFERENCES category(categoryId),
    FOREIGN KEY(productId) REFERENCES product(productId)
);

CREATE TABLE `eCommercePractice`.`productMeta`(
	`productMetaId` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `productId` BIGINT(20) NOT NULL,
    `key` VARCHAR(50) NOT NULL,
    `content` TEXT,
    PRIMARY KEY(productMetaId),
    FOREIGN KEY(productId) REFERENCES product(productId)
);

ALTER TABLE `ecommercepractice`.`productmeta` 
CHANGE COLUMN `key` `key` VARCHAR(64) NOT NULL ;

CREATE TABLE `eCommercePractice`.`productReview`(
	`reviewId` BIGINT(24) NOT NULL AUTO_INCREMENT,
    `productId` BIGINT(24) NOT NULL,
    `parentid` BIGINT(24),
    `title` VARCHAR(104) NOT NULL,
    `rating` SMALLINT(8) NOT NULL,
    `published` TINYINT(1) NOT NULL,
    `createdAt` DATETIME NOT NULL,
    `publishedAt` DATETIME,
    `content` TEXT,
    PRIMARY KEY(reviewId),
    FOREIGN KEY(productId) REFERENCES product(productId)
);

CREATE TABLE `eCommercePractice`.`cart`(
	`cartId` BIGINT(24) NOT NULL AUTO_INCREMENT,
    `userId` BIGINT(24),
    `sessionId` VARCHAR(104) NOT NULL,
    `token` VARCHAR(104) NOT NULL,
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
    PRIMARY KEY(cartId),
    FOREIGN KEY(userId) REFERENCES user(userid)
);

CREATE TABLE `eCommercePractice`.`cartItem` (
  `itemId` BIGINT NOT NULL AUTO_INCREMENT,
  `productId` BIGINT NOT NULL,
  `cartId` BIGINT NOT NULL,
  `sku` VARCHAR(104) NOT NULL,
  `price` FLOAT NOT NULL,
  `discount` FLOAT NOT NULL,
  `quantity` SMALLINT(8) NOT NULL,
  `active` TINYINT(1) NOT NULL,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME,
  `content` TEXT,
  PRIMARY KEY (`itemId`),
  FOREIGN KEY (`productId`) REFERENCES product (productId)
);

CREATE TABLE `eCommercePractice`.`order` (
  `orderId` BIGINT NOT NULL AUTO_INCREMENT,
  `userId` BIGINT NULL DEFAULT NULL,
  `sessionId` VARCHAR(104) NOT NULL,
  `token` VARCHAR(104) NOT NULL,
  `status` SMALLINT(8) NOT NULL,
  `subTotal` FLOAT NOT NULL,
  `itemDiscount` FLOAT NOT NULL,
  `tax` FLOAT NOT NULL,
  `shipping` FLOAT NOT NULL,
  `total` FLOAT NOT NULL,
  `promo` VARCHAR(64),
  `discount` FLOAT NOT NULL,
  `grandTotal` FLOAT NOT NULL,
  `firstName` VARCHAR(64),
  `middleName` VARCHAR(64),
  `lastName` VARCHAR(64),
  `mobile` VARCHAR(64),
  `email` VARCHAR(64),
  `line1` VARCHAR(64),
  `line2` VARCHAR(64),
  `city` VARCHAR(64),
  `province` VARCHAR(64),
  `country` VARCHAR(64),
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME,
  `content` TEXT,
  PRIMARY KEY (`orderId`),
  FOREIGN KEY (`userId`) REFERENCES `eCommercePractice`.`user` (`userId`)
);

CREATE TABLE `eCommercePractice`.`orderItem` (
  `orderItemId` BIGINT NOT NULL AUTO_INCREMENT,
  `productId` BIGINT NOT NULL,
  `orderId` BIGINT NOT NULL,
  `sku` VARCHAR(104) NOT NULL,
  `price` FLOAT NOT NULL,
  `discount` FLOAT NOT NULL,
  `quantity` SMALLINT(8) NOT NULL,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME,
  `content` TEXT,
  PRIMARY KEY (`orderItemId`),
  FOREIGN KEY (`productId`) REFERENCES `eCommercePractice`.`product` (`productId`)
);

CREATE TABLE `eCommercePractice`.`transaction` (
  `transactionId` BIGINT NOT NULL AUTO_INCREMENT,
  `userId` BIGINT NOT NULL,
  `orderId` BIGINT NOT NULL,
  `code` VARCHAR(104) NOT NULL,
  `type` SMALLINT(8) NOT NULL,
  `mode` SMALLINT(8) NOT NULL,
  `status` SMALLINT(8) NOT NULL,
  `createdAt` DATETIME NOT NULL,
  `updatedAt` DATETIME,
  `content` TEXT,
  PRIMARY KEY (`transactionId`),
  FOREIGN KEY (`userId`) REFERENCES `eCommercePractice`.`user` (`userId`)
);

CREATE TABLE `eCommercePractice`.`tag`(
	`tagId` BIGINT(24) NOT NULL  AUTO_INCREMENT,
    `title` VARCHAR(104) NOT NULL,
    `metaTitle` VARCHAR(104),
    `content` TEXT,
    PRIMARY KEY(`tagId`)
);    

CREATE TABLE `eCommercePractice`.`producttag`(
	`productId` BIGINT(24) NOT NULL,
    `tagId` BIGINT(24) NOT NULL,
    FOREIGN KEY(productId) REFERENCES product(productId),
    FOREIGN KEY(tagId) REFERENCES tag(tagId)
);

/* INSERT INTO Category*/

INSERT INTO  `eCommercePractice`.`category`(`categoryId`,`parentId`,`title`,`metaTitle`,`content`) VALUES 
('001' ,'000','cat1','cat1','cat1 Content'),
('002' ,'000','cat2','cat2','cat2 Content'),
('003' ,'001','cat12','cat12','cat12 Content'),
('004' ,'001','cat122','cat122','cat122 Content'),
('005' ,'002','cat21','cat21','cat21 Content'),
('006' ,'002','cat211','cat211','cat211 Content'); 

/* INSERT INTO user*/
INSERT INTO  `eCommercePractice`.`user`(`firstName`,`middleName`,`lastName`,`mobile`,`email`,`passwordHash`,`admin`,`vendor`,`registeredAt`,`lastLogin`,`intro`,`profile`) VALUES ('Darpan1' ,'Manoj','Vadher','9898678669','darpan1test007@gmail.com','Darpan1','1','0','2022-01-19','2022-01-19','Hello1','darpan1'),
('Darpan2' ,'Manoj','Vadher','9898678668','darpan2test007@gmail.com','Darpan2','0','1','2022-01-19','2022-01-19','Hello2','darpan2'),
('Darpan3' ,'Manoj','Vadher','9898678679','darpan3test007@gmail.com','Darpan3','0','0','2022-01-19','2022-01-19','Hello3','darpan3'),
('Darpan4' ,'Manoj','Vadher','9898678660','darpan4test007@gmail.com','Darpan4','0','0','2022-01-19','2022-01-19','Hello4','darpan4');


/* INSERT INTO product */
INSERT INTO `eCommercePractice`.`product` 
(`title`, `metaTUitle`, `summary`, `type`, `sku`, `price`, `discount`, `quantity`, `shop`, `createdAt`, 
`updatedAt`, `publishedAt`, `startAt`, `endsAt`, `content`) 
VALUES ('REDMI NOTE10', 'REDMI NOTE10' , 'REDMI NOTE10 mobile', '1', '1', '20000', '0', '10', '1', '2022-01-01', '2022-01-01', '2022-01-05', '2022-01-01', '2022-01-19', 'mobilePhone'),
('REDMI NOTE11', 'REDMI NOTE11' , 'REDMI NOTE11 mobile', '1', '1', '21000', '0', '11', '1', '2022-01-01', '2022-01-01', '2022-01-05', '2022-01-01', '2022-01-19', 'mobilePhone'),
('REDMI NOTE12', 'REDMI NOTE12' , 'REDMI NOTE12 mobile', '1', '1', '22000', '0', '15', '1', '2022-01-01', '2022-01-01', '2022-01-05', '2022-01-01', '2022-01-19', 'mobilePhone'),
('REDMI NOTE13', 'REDMI NOTE13' , 'REDMI NOTE13 mobile', '1', '1', '23000', '0', '19', '1', '2022-01-01', '2022-01-01', '2022-01-05', '2022-01-01', '2022-01-19', 'mobilePhone'),
('REDMI NOTE14', 'REDMI NOTE14' , 'REDMI NOTE14 mobile', '1', '1', '24000', '0', '13', '1', '2022-01-01', '2022-01-01', '2022-01-05', '2022-01-01', '2022-01-19', 'mobilePhone');


/*Insert INTO CatagoryProduct */
INSERT INTO `ecommercepractice`.`productcategory`
(`productId`,`categoryId`) VALUES
('1','3'),
('2','3'),
('3','4'),
('4','4'),
('5','1');


/*Insert INTO Productmeta */
INSERT INTO `eCommercePractice`.`productMeta` ( `productId`, `key`, `content`) VALUES 
( '1', 'REDMI NOTE10', 'REDMI NOTE10 mobile'),
('2', 'REDMI NOTE11', 'REDMI NOTE11 mobile'),
('3', 'REDMI NOTE12', 'REDMI NOTE12 mobile'),
('4', 'REDMI NOTE13', 'REDMI NOTE13 mobile'),
('5', 'REDMI NOTE14', 'REDMI NOTE14 mobile');


/*Insert Into productReview */
INSERT INTO `eCommercePractice`.`productReview` 
(`productId`, `parentid`, `title`, `rating`, `published`, `createdAt`, `publishedAt`, `content`) 
VALUES ('1', '1', 'mobile reviiew', '5', '1', '2022-01-19', '2022-01-19', 'very good quality'),
('2', '1', 'mobile2 reviiew', '4', '1', '2022-01-19', '2022-01-19', 'good quality'),
('3', '1', 'mobile3 reviiew', '3', '1', '2022-01-19', '2022-01-19', 'thik'),
('4', '1', 'mobile4 reviiew', '2', '1', '2022-01-19', '2022-01-19', 'poor quality'),
('5', '1', 'mobile5 reviiew', '1', '1', '2022-01-19', '2022-01-19', 'bad quality');

/*Insert Into order */
INSERT INTO `eCommercePractice`.`order` 
(`userId`, `sessionId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, `total`, `promo`, `discount`, 
`grandTotal`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, `province`, `country`, `createdAt`, 
`updatedAt`, `content`) 
VALUES ('1', '1', 'jbhvc', '1', '20000', '0', '200', '200', '20400', '', '0', '20400', 'Darpan', 'manoj', 'vadher', 
'9898678669', 'darpantest007', '302/', 'mg road', 'dahod', 'near xyz shop', 'india', '2022-01-01', '2022-01-19', 'mobile prchase'),
('2', '1', 'jbhvc', '1', '22000', '0', '200', '200', '22400', '', '0', '22400', 'Darpan', 'manoj', 'vadher', 
'9898678669', 'darpan2test007', '302/', 'mg road', 'dahod', 'near xyz shop', 'india', '2022-01-01', '2022-01-19', 'mobile prchase');
INSERT INTO `eCommercePractice`.`order` (`userId`, `sessionId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, 
`total`, `promo`, `discount`, `grandTotal`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, 
`province`, `country`, `createdAt`, `updatedAt`, `content`) 
VALUES ('3', '1', 'jbhvc', '1', '20000', '2000', '0', '0', '20400', 'SUPER10', '0', '18000', 'Darpan', 'manoj', 'vadher', '9898678669', 
'darpantest007', '302/', 'mg road', 'dahod', 'near xyz shop', 'india', '2022-01-01', '2022-01-19', 'mobile prchase');
INSERT INTO `ecommercepractice`.`order` (`orderId`, `userId`, `sessionId`, `token`, `status`, `subTotal`, `itemDiscount`, `tax`, `shipping`, 
`total`, `discount`, `grandTotal`, `firstName`, `middleName`, `lastName`, `mobile`, `email`, `line1`, `line2`, `city`, 
`province`, `country`, `createdAt`, `updatedAt`, `content`) 
VALUES ('4', '1', '1', 'jbhvc', '1', '20000', '0', '200', '200', '22400', '0', '20400', 'Darpan', 'manoj', 'vadher', '8888888888', 
'darpan@gmail.com', '302/', 'mg road', 'dahod', 'near xyz store', 'india', '2022-01-01 00:00:00 ', '2022-01-19 00:00:00', 'jeans');
UPDATE `ecommercepractice`.`order` SET `discount` = '2000' WHERE (`orderId` = '3');


/*Insert Into order item */

INSERT INTO `eCommercePractice`.`orderitem`
(`productId`,`orderId`,`sku`,`price`,`discount`,`quantity`,`createdAt`,`updatedAt`,`content`)
VALUES
('1','1','1','20000','0','1','2022-01-01', '2022-01-19','Mobile Purchase'),
('3','2','1','22000','0','1','2022-01-01', '2022-01-19','Mobile Purchase');

/*Insert Into order transaction */

INSERT INTO `ecommercepractice`.`transaction`
(`userId`,`orderId`,`code`,`type`,`mode`,`status`,`createdAt`,`updatedAt`,`content`)
VALUES
('1','1','aaa','1','1','1','2022-01-01', '2022-01-19','mobile purchase'),
('2','2','aaa','1','1','1','2022-01-01', '2022-01-19','mobile purchase');

/* INSERT INTO tag*/

INSERT INTO  `eCommercePractice`.`tag`(`title`,`metaTitle`,`content`) VALUES 
('tag1','tag1','tag1 Content'),
('tag2','tag2','tag2 Content'),
('tag3','tag3','tag3 Content'),
('tag4','tag4','tag4 Content'),
('tag5','tag5','tag5 Content');

/*Insert INTO ProductTag */
INSERT INTO `ecommercepractice`.`producttag`
(`productId`,`tagId`) VALUES
('1','1'),
('1','3'),
('2','2'),
('4','4'),
('5','1');

/* Get all the products which are having price between 20000 to 21000 */
SELECT * FROM  `eCommercePractice`.`product` WHERE  price BETWEEN 20000 AND 21000;

/* Get all the products sorted based on created date */
SELECT * FROM `eCommercePractice`.`product` ORDER BY createdAt;

/* Get total sub total of all the orders */
SELECT SUM(subtotal) FROM `eCommercePractice`.`order`;

/* Get total discount applied in all the orders */
SELECT SUM(discount) FROM `eCommercePractice`.`order`;

/* Get data of particular user that how many orders they are having  */
SELECT Count(orderId) From `eCommercePractice`.`order` group by userId;

/*Get orders list which is having promo applied in that order*/
SELECT * FROM `eCommercePractice`.`order` WHERE promo != '';

/* Get current active carts details  */
SELECT * FROM `eCommercePractice`.`cart` WHERE status = 1;

/* Get products which is having qty between 20 to 30 */
SELECT * FROM  `eCommercePractice`.`product` WHERE  quantity BETWEEN 20 AND 30;

/* Get all the categories which are having at least one sub category */
SELECT productId FROM `eCommercePractice`.`productCategory` group by productId having count(categoryId) > 1;

/*Get all the products which are updated in last 2 hours*/
SELECT * from  `eCommercePractice`.`product` where updatedAt >= DATE_SUB(NOW(),INTERVAL 2 HOUR);

/* 19-01-01 */
/*query 1 : List all the product names which are assigned to category ID 1.*/
SELECT product.title FROM `eCommercePractice`.`product`
JOIN eCommercePractice.productcategory ON product.productId=productcategory.productId AND productcategory.categoryId=1;

/*query 2 : Get the active product count which is assigned to category ID 2.*/
SELECT COUNT(product.productId) FROM `eCommercePractice`.`product` 
JOIN `eCommercePractice`.`productCategory` Where product.productId = productcategory.productId AND product.shop = 1 AND productcategory.categoryId = 2;

/*query 3 : Show all category names which are assigned to Product ID 1.*/
SELECT category.title FROM `eCommercePractice`.`category`
JOIN eCommercePractice.productcategory ON category.categoryId=productcategory.categoryId AND productcategory.productId=1;

/*query 4 : List out all the tag names which are assigned to Product ID 1.*/
SELECT tagTab.title FROM `eCommercePractice`.`tag` AS tagTab 
INNER JOIN `eCommercePractice`.`producttag` AS prodTag WHERE tagTab.tagId = prodTag.tagId AND prodTag.productId =1; 

/*query 5 : Show product reviews with product name if product is active.*/
SELECT product.title ,productreview.title FROM `eCommercePractice`.`productreview` LEFT JOIN  eCommercePractice.product
ON product.productId = productreview.productId AND product.shop = 1;

/*query 6 : List out product names and product ids which have at least one order available.*/
SELECT product.title , product.productId FROM eCommercePractice.product
INNER JOIN eCommercePractice.orderitem WHERE product.productId = orderitem.productId;

/*query 7 : Show the product names, ids and total qty purchased so far for each product.*/
SELECT product.title , product.productId , SUM(orderitem.quantity) FROM eCommercePractice.product 
INNER JOIN eCommercePractice.orderitem WHERE product.productId = orderItem.productId group by product.productId;

/*query 8 :Show User ID and Order ID associated with that User.*/
SELECT `order`.`userId` , `order`.`orderId` FROM eCommercePractice.order;

/*query 9 :Show total subtotal of all the orders for user id 1.*/
SELECT SUM(subtotal) FROM `eCommercePractice`.`order` WHERE userId = '1';

/*query 10 : Show all the orders which are created on 19th Jan*/
SELECT * FROM `eCommercePractice`.`order` WHERE createdAt = '2022-01-01';

/*query 11 : Show product names and their product ids which are placed in order id 1.*/
SELECT product.title , product.productId FROM eCommercePractice.product
INNER JOIN eCommercePractice.orderitem WHERE product.productId = orderitem.orderItemId AND orderitem.orderId = 1;

/*query 12 : List out the order of user ID 1 which has a discount greater than 100.*/
SELECT * from `ecommercePractice`.`order` WHERE userId = '3' AND discount > 100;