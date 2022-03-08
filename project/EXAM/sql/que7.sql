USE exam;

CREATE TABLE `exam`.`employee`(
	`employeeId` INT NOT NULL AUTO_INCREMENT,
    `teamId` INT NOT NULL,
    PRIMARY KEY(`employeeId`)
);

SELECT * FROM `exam`.`employee`;

INSERT INTO `exam`.`employee` (`employeeId`, `teamId`) VALUES ('1', '8');
INSERT INTO `exam`.`employee` (`employeeId`, `teamId`) VALUES ('2', '8');
INSERT INTO `exam`.`employee` (`employeeId`, `teamId`) VALUES ('3', '8');
INSERT INTO `exam`.`employee` (`employeeId`, `teamId`) VALUES ('4', '7');
INSERT INTO `exam`.`employee` (`employeeId`, `teamId`) VALUES ('5', '9');
INSERT INTO `exam`.`employee` (`employeeId`, `teamId`) VALUES ('6', '9');

/* Write an SQL query to find the team size of each of the employees. */

SELECT e1.employeeId , e2.total FROM exam.employee AS e1 , 
(SELECT teamId , count(*) AS total FROM exam.employee GROUP BY teamId) AS e2
WHERE e1.teamId = e2.teamId;