USE exam;

CREATE TABLE `exam`.`products`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `productId` INT NOT NULL,
    `newPrice` INT NOT NULL,
    `changedDate` DATE NOT NULL,
    PRIMARY KEY(`id`)
);

SELECT * FROM `exam`.`products`;

INSERT INTO `exam`.`products` (`productId`, `newPrice`, `changedDate`) VALUES ('1', '20', '2019-08-14');
INSERT INTO `exam`.`products` (`productId`, `newPrice`, `changedDate`) VALUES ('2', '50', '2019-08-14');
INSERT INTO `exam`.`products` (`productId`, `newPrice`, `changedDate`) VALUES ('1', '30', '2019-08-15');
INSERT INTO `exam`.`products` (`productId`, `newPrice`, `changedDate`) VALUES ('1', '35', '2019-08-16');
INSERT INTO `exam`.`products` (`productId`, `newPrice`, `changedDate`) VALUES ('2', '65', '2019-08-17');
INSERT INTO `exam`.`products` (`productId`, `newPrice`, `changedDate`) VALUES ('3', '20', '2019-08-18');

/* Write an SQL query to find the prices of all products on 2019-08-16. 
Assume the price of all products before any change is 10. */

SELECT productId,(
CASE
	WHEN changedDate <= '2019-08-16'  THEN
		newPrice
	ELSE
		10
END) AS price ,changedDate
FROM `exam`.`products`  GROUP BY productId;


/* try 2 */
SELECT productId, newPrice AS price
FROM Products
WHERE (productId, changedDate) IN (SELECT productId, MAX(changedDate)
                                    FROM Products
                                    WHERE changedDate <= '2019-08-16'
                                    GROUP BY productId) 
                                    
                                    
                                    