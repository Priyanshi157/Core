CREATE SCHEMA `employee`;

CREATE TABLE `employee`.`person`(
	`personId` INT NOT NULL AUTO_INCREMENT,
    `personEmail` VARCHAR(64) NOT NULL,
	constraint check_lowercase_personEmail check (lower(personEmail) = personEmail),
    PRIMARY KEY (`personId`)
);

CREATE TABLE `employee`.`department`(
	`departmentId` INT NOT NULL AUTO_INCREMENT,
    `departmentName` VARCHAR(64) NOT NULL,
    PRIMARY KEY(`departmentId`)
);

CREATE TABLE `employee`.`employee1`(
	`employeeId` INT NOT NULL AUTO_INCREMENT,
    `employeeName` VARCHAR(32) NOT NULL,
    `salary` INT(16) NOT NULL,
    `departmentId` INT NOT NULL,
    PRIMARY KEY(`employeeId`),
    FOREIGN KEY(`departmentId`) REFERENCES DEPARTMENT(`departmentId`)
);

INSERT INTO `employee`.`person` (`personEmail`) VALUES ('abc@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('xyz@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('abc@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('xyz@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('pqr@gmail.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('ABC@gmaol.com');
INSERT INTO `employee`.`person` (`personEmail`) VALUES ('ABC@gmaol.com');


INSERT INTO `employee`.`department` (`departmentName`) VALUES ('Staff');
INSERT INTO `employee`.`department` (`departmentName`) VALUES ('Software Developer');
INSERT INTO `employee`.`department` (`departmentName`) VALUES ('Account');

INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Priyanshi', '20000', '2');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Darpan', '25000', '2');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Kwinsi', '23000', '3');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Jay', '19000', '3');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Joey', '15000', '1');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Rachel', '12000', '1');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Monica', '30000', '2');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Ross', '12000', '1');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Daisy', '40000', '2');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Henry', '35000', '3');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Vivek', '22500', '1');
INSERT INTO `employee`.`employee1` (`employeeName`, `salary`, `departmentId`) VALUES ('Fenil', '25000', '3');

/*Write an SQL query to report all the duplicate emails. Return the result table in any order*/
SELECT lower(personEmail)
FROM `employee`.`person`
GROUP BY  personEmail
HAVING COUNT(*) > 1;

/* Write an SQL query to find the employees who are high earners in each of the departments. 
Return the result table in any order. The query result format is in the following example. */
SELECT
    dpt.departmentName AS Department,
    e1.employeeName AS Employee,
    e1.salary AS Salary
FROM `employee`.`employee1` AS e1
INNER JOIN `employee`.`department` dpt
ON e1.departmentId = dpt.departmentId
WHERE 3 > (
           SELECT COUNT(DISTINCT salary)
           FROM `employee`.`employee1` AS e2
           WHERE e2.salary > e1.salary
           AND e1.departmentId = e2.departmentId
          )
ORDER BY
Department ASC,
Salary DESC;


/*
CREATE TABLE `employee`.`employee_table` (
  `eid` INT NOT NULL,
  `ename` VARCHAR(45) NOT NULL,
  `edesignation` VARCHAR(45) NOT NULL,
  `dob` VARCHAR(45) NOT NULL,
  `start_date` VARCHAR(45) NOT NULL,
  `end_date` VARCHAR(45) NULL,
  `phone_no` INT NOT NULL,
  `gender` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`eid`, `start_date`))
COMMENT = '	';

ALTER TABLE `employee`.`employee_table` 
CHANGE COLUMN `phone_no` `phone_no` VARCHAR(10) NOT NULL;

INSERT INTO `employee`.`employee_table` (
`eid`, `ename`, `edesignation`, `dob`, `start_date`, `phone_no`, `gender`) 
VALUES ('1', 'Priyanshi', 'trainee', '15/7/1999', '3/1/2022', '8888888888', 'Female');

INSERT INTO `employee`.`employee_table` (
`eid`, `ename`, `edesignation`, `dob`, `start_date`, `phone_no`, `gender`) 
VALUES ('2', 'Kwinsi', 'trainee', '13/3/2000', '3/1/2022', '7777777777', 'Female');

*/