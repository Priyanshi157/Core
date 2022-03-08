USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`person1`(
	`personId` INT NOT NULL AUTO_INCREMENT,
    `lastName` VARCHAR(64) NOT NULL,
    `fIrstName` VARCHAR(64) NOT NULL,
    PRIMARY KEY(`personId`)
);


CREATE TABLE `DatabaseQueries3`.`address`(
	`addressId` INT NOT NULL AUTO_INCREMENT,
    `personId` INT NOT NULL,
	`city` VARCHAR(64) NOT NULL,
    `state` VARCHAR(64) NOT NULL,
    PRIMARY KEY(`addressId`),
    FOREIGN KEY(`personId`) REFERENCES person1(`personId`)
);

SELECT * FROM `DatabaseQueries3`.`person1`;

INSERT INTO `DatabaseQueries3`.`person1` (`personId`, `lastName`, `fIrstName`) VALUES ('1', 'Wang', 'Allen');
INSERT INTO `DatabaseQueries3`.`person1` (`personId`, `lastName`, `fIrstName`) VALUES ('2', 'Alice', 'Bob');
INSERT INTO `DatabaseQueries3`.`person1` (`personId`, `lastName`, `fIrstName`) VALUES ('3', 'Joey', 'Mekwan');

SELECT * FROM `DatabaseQueries3`.`address`;

INSERT INTO `DatabaseQueries3`.`address` (`addressId`, `personId`, `city`, `state`) VALUES ('1', '2', 'New york city', 'New York');
INSERT INTO `DatabaseQueries3`.`address` (`addressId`, `personId`, `city`, `state`) VALUES ('2', '1', 'Leetcode', 'California');


/*Write an SQL query to report the first name, last name, city, and state of each person in the Person table. 
If the address of a personId is not present in the Address table, report null instead. Return the result table in any order.*/

SELECT person1.firstName , person1.lastName ,address.city , address.state FROM `DatabaseQueries3`.`person1`
LEFT JOIN `DatabaseQueries3`.`address` ON person1.personId = address.personId;