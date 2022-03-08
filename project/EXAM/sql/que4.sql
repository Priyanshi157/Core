USE exam;

CREATE TABLE `exam`.`product`(
	`productId` INT NOT NULL,
    PRIMARY KEY(`productId`)
);

CREATE TABLE `exam`.`customer`(
	`orderId` INT NOT NULL AUTO_INCREMENT,
	`customerId` INT NOT NULL,
	`productId` INT NOT NULL,
    PRIMARY KEY(`orderId`),
    FOREIGN KEY(`productId`) REFERENCES product(`productId`)
);

SELECT * FROM `exam`.`product`;

INSERT INTO `exam`.`product` (`productId`) VALUES ('5');
INSERT INTO `exam`.`product` (`productId`) VALUES ('6');

SELECT * FROM `exam`.`customer`;

INSERT INTO `exam`.`customer` (`customerId`, `productId`) VALUES ('1', '5');
INSERT INTO `exam`.`customer` (`customerId`, `productId`) VALUES ('2', '6');
INSERT INTO `exam`.`customer` (`customerId`, `productId`) VALUES ('3', '5');
INSERT INTO `exam`.`customer` (`customerId`, `productId`) VALUES ('3', '6');
INSERT INTO `exam`.`customer` (`customerId`, `productId`) VALUES ('1', '6');

/* Write an SQL query to report the customer ids from the Customer table 
that bought all the products in the Product table. Return the result 
table in any order.*/

SELECT DISTINCT customerId FROM customer 
GROUP BY customerId HAVING count(productId) = (SELECT count(*) FROM product);