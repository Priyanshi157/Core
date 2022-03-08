USE exam;

CREATE TABLE exam.customers(
	`id` INT NOT NULL AUTO_INCREMENT,
	`customerId` INT NOT NULL,
    `name` VARCHAR(64) NOT NULL,
    `visitedOn` DATE NOT NULL,
    `amount` INT NOT NULL,
    PRIMARY KEY(`id`)
);

SELECT * FROM exam.customers;

INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('1', 'jhon', '2019-01-01', '100');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('2', 'daniel', '2019-01-02', '110');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('3', 'jade', '2019-01-03', '120');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('4', 'khaled', '2019-01-04', '130');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('5', 'winston', '2019-01-05', '110');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('6', 'elvis', '2019-01-06', '140');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('7', 'anna', '2019-01-07', '150');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('8', 'maria', '2019-01-08', '80');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('9', 'jaze', '2019-01-09', '110');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('1', 'jhon', '2019-01-10', '130');
INSERT INTO `exam`.`customers` (`customerId`, `name`, `visitedOn`, `amount`) VALUES ('3', 'jade', '2019-01-10', '150');

/*You are the restaurant owner and you want to analyze a possible expansion 
(there will be at least one customer every day).
Write an SQL query to compute the moving average of how much the customer 
paid in a seven days window (i.e., current day + 6 days before). 
average_amount should be rounded to two decimal places.*/

SELECT c1.visitedOn , c1.amount, 
Round(
	(SELECT AVG(amount) FROM customers AS c2 
	WHERE DATEDIFF(c1.visitedOn,c2.visitedOn) BETWEEN 0 AND 6 )
) AS 'average' FROM customers AS c1
WHERE id > 6
GROUP BY c1.visitedOn
ORDER BY c1.visitedOn;
