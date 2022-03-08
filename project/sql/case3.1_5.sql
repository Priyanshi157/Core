USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`customers`(
	`customerId` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(64) NOT NULL,
    PRIMARY KEY(`customerId`)
);


CREATE TABLE `DatabaseQueries3`.`orders`(
	`orderId` INT NOT NULL AUTO_INCREMENT,
    `customerId` INT NOT NULL,
    PRIMARY KEY(`orderId`),
    FOREIGN KEY(`customerId`) REFERENCES customers(`customerId`)
);

SELECT * FROM `DatabaseQueries3`.`customers`;

INSERT INTO `DatabaseQueries3`.`customers` (`customerId`, `name`) VALUES ('1', 'Joe');
INSERT INTO `DatabaseQueries3`.`customers` (`customerId`, `name`) VALUES ('2', 'Henry');
INSERT INTO `DatabaseQueries3`.`customers` (`customerId`, `name`) VALUES ('3', 'Sam');
INSERT INTO `DatabaseQueries3`.`customers` (`customerId`, `name`) VALUES ('4', 'Max');

SELECT * FROM `DatabaseQueries3`.`orders`;

INSERT INTO `DatabaseQueries3`.`orders` (`orderId`, `customerId`) VALUES ('1', '2');
INSERT INTO `DatabaseQueries3`.`orders` (`orderId`, `customerId`) VALUES ('3', '1');

/* Write an SQL query to report all customers who never order anything. Return the result table in any order. */

SELECT customers.name FROM `DatabaseQueries3`.`customers` 
LEFT JOIN `DatabaseQueries3`.`orders` ON customers.customerId = orders.customerId
WHERE orders.customerId is NULL;