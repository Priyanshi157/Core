CREATE SCHEMA DatabaseQueries3;

USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`employee`(
	`empId` INT NOT NULL AUTO_INCREMENT,
    `firstName` VARCHAR(64) NOT NULL,
    `middleName` VARCHAR(64) NOT NULL,
    `lastName` VARCHAR(64) NOT NULL,
    `email` VARCHAR(128) NOT NULL,
    `gender` ENUM('M','F') NOT NULL,
    `designation` VARCHAR(64) NOT NULL,
    `phoneNo` VARCHAR(16) NOT NULL,
    `dob` DATE,
    `startDate` DATETIME NOT NULL,
    `endDate` DATETIME,
    `salary` INT(7) NOT NULL,
    PRIMARY KEY(empId)
);

SELECT * FROM `DatabaseQueries3`.`employee`;

INSERT INTO `DatabaseQueries3`.`employee` (`empId`, `firstName`, `middleName`, `lastName`, `email`, `gender`, 
`designation`, `phoneNo`, `dob`, `startDate`, `salary`) 
VALUES ('1', 'Krishna', 'Mahesh', 'Makvana', 'krishna@gmail.com', 'F', 'software developer', '9874561230', '1999-11-25', '2021-01-01', '25000');

INSERT INTO `DatabaseQueries3`.`employee` (`empId`, `firstName`, `middleName`, `lastName`, `email`, `gender`, 
`designation`, `phoneNo`, `dob`, `startDate`, `salary`)
VALUES ('2', 'Disha', 'Lokesh', 'Chavda', 'disha@gmail.com', 'F', 'database manager', '8975400012', '1997-05-30', '2019-11-01', '35000');

INSERT INTO `DatabaseQueries3`.`employee` (`empId`, `firstName`, `middleName`, `lastName`, `email`, `gender`, 
`designation`, `phoneNo`, `dob`, `startDate`, `salary`) 
VALUES ('3', 'Roshani', 'Dharmesh', 'Gohel', 'roshani@gmail.com', 'F', 'staff', '9784562154', '1999-06-22', '2022-01-03', '18000');

CREATE TABLE `DatabaseQueries3`.`leaves`(
	`leaveId` INT NOT NULL AUTO_INCREMENT,		
    `empId` INT NOT NULL,
    `startDate` DATE,
    `endDate` DATE,
    `reason` VARCHAR(1024),
    `days` INT NOT NULL DEFAULT 0,
    PRIMARY KEY(leaveId),
    FOREIGN KEY(`empId`) REFERENCES `DatabaseQueries3`.`employee`(empId)
);

SELECT * FROM `Databasequeries3`.`leaves`;
INSERT INTO `DatabaseQueries3`.`leaves` (`leaveId`, `empId`, `startDate`, `endDate`, `reason`, `days`) VALUES ('1', '1', '2021-01-15', '2022-01-17', 'Health', '3');
INSERT INTO `DatabaseQueries3`.`leaves` (`leaveId`, `empId`, `startDate`, `endDate`, `reason`, `days`) VALUES ('2', '2', '2020-05-16', '2020-05-20', 'merriage', '5');
INSERT INTO `DatabaseQueries3`.`leaves` (`leaveId`, `empId`, `startDate`, `endDate`, `reason`, `days`) VALUES ('3', '2', '2021-01-17', '2021-01-20', 'Health', '4');
INSERT INTO `DatabaseQueries3`.`leaves` (`leaveId`, `empId`, `startDate`, `endDate`, `reason`, `days`) VALUES ('4', '1', '2021-12-10', '2021-12-13', 'merriage', '4');
INSERT INTO `DatabaseQueries3`.`leaves` (`leaveId`, `empId`, `days`) VALUES ('5', '3', '0');

/* It should include all the employee's information as well as their leave information */
SELECT emp.empId , emp.firstName , emp.middleName , emp.lastName , emp.email , emp.gender , emp.designation , emp.phoneNo , 
emp.dob , emp.startDate , emp.endDate , emp.salary , 
le.leaveId , le.startDate , le.endDate , le.reason , le.days 
FROM `DatabaseQueries3`.`employee` AS emp , `DatabaseQueries3`.`leaves` AS le
WHERE emp.empId = le.empId;