CREATE SCHEMA `adapter`;

CREATE TABLE `adapter`.`product`(
	`productId` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    `quantity` INT NOT NULL,
    `price` INT NOT NULL,
    PRIMARY KEY(`productId`)
);