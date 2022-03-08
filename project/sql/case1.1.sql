CREATE SCHEMA `employee`;

CREATE TABLE `employee`.`person`(
	`personId` INT NOT NULL AUTO_INCREMENT,
    `personEmail` VARCHAR(64) NOT NULL,
	constraint check_lowercase_personEmail check (lower(personEmail) = personEmail),
    PRIMARY KEY (`personId`)
);

INSERT INTO `employee`.`person` (`personEmail`) VALUES ('abc@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('xyz@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('abc@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('xyz@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('pqr@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('ABC@gmaol.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('ABC@gmaol.com');

/*Write an SQL query to report all the duplicate emails. Return the result table in any order*/
SELECT lower(personEmail)
FROM `employee`.`person`
GROUP BY  personEmail
HAVING COUNT(*) > 1;
