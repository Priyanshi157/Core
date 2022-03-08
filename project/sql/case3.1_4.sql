/*
Write an SQL query to delete all the duplicate emails, keeping only one unique email with the smallest id. Return the result table in any order.
*/

USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`person`(
	`personId` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(64) NOT NULL,
    PRIMARY KEY(`personId`)
);

SELECT * FROM `DatabaseQueries3`.`person`;

INSERT INTO `DatabaseQueries3`.`person` (`personId`, `email`) VALUES ('1', 'john@example.com');
INSERT INTO `DatabaseQueries3`.`person` (`personId`, `email`) VALUES ('2', 'bob@example.com');
INSERT INTO `DatabaseQueries3`.`person` (`personId`, `email`) VALUES ('3', 'john@example.com ');
INSERT INTO `DatabaseQueries3`.`person` (`personId`, `email`) VALUES ('4', 'john@example.com ');

DELETE p1 FROM person p1, person p2 WHERE p1.personId > p2.personId AND p1.email = p2.email;

SELECT * FROM `DatabaseQueries3`.`person`;