USE exam;

CREATE TABLE `exam`.`orders`(
	`orderNo` INT NOT NULL AUTO_INCREMENT,
    `customerNo` INT NOT NULL,
    PRIMARY KEY(`orderNo`)
);

SELECT * FROM `exam`.`orders`;

INSERT INTO `exam`.`orders` (`orderNo`, `customerNo`) VALUES ('1', '1');
INSERT INTO `exam`.`orders` (`orderNo`, `customerNo`) VALUES ('2', '2');
INSERT INTO `exam`.`orders` (`orderNo`, `customerNo`) VALUES ('3', '3');
INSERT INTO `exam`.`orders` (`orderNo`, `customerNo`) VALUES ('4', '3');

/* Write an SQL query to find the customer_number for the customer who has 
placed the largest number of orders.*/

SELECT customerNo FROM exam.orders
GROUP BY customerNo
ORDER BY count(*)
DESC LIMIT 1;