CREATE SCHEMA exam;

CREATE TABLE `exam`.`department`(
	`deptId` INT NOT NULL AUTO_INCREMENT,
    `deptName` VARCHAR(128) NOT NULL,
    PRIMARY KEY(`deptId`)
);

CREATE TABLE `exam`.`student`(
	`studentId` INT NOT NULL,
    `studentName` VARCHAR(64) NOT NULL,
    `gender` VARCHAR(16) NOT NULL,
    `deptId` INT NOT NULL,
    PRIMARY KEY(`studentId`),
    FOREIGN KEY(`deptId`) REFERENCES `department`(`deptId`)
);

SELECT * FROM `exam`.`department`;

INSERT INTO `exam`.`department` (`deptId`, `deptName`) VALUES ('1', 'engineering');
INSERT INTO `exam`.`department` (`deptId`, `deptName`) VALUES ('2', 'science');
INSERT INTO `exam`.`department` (`deptId`, `deptName`) VALUES ('3', 'law');

SELECT * FROM `exam`.`student`;

INSERT INTO `exam`.`student` (`studentId`, `studentName`, `gender`, `deptId`) VALUES ('1', 'jack', 'M', '1');
INSERT INTO `exam`.`student` (`studentId`, `studentName`, `gender`, `deptId`) VALUES ('2', 'jane', 'F', '1');
INSERT INTO `exam`.`student` (`studentId`, `studentName`, `gender`, `deptId`) VALUES ('3', 'mark', 'M', '2');

/*Write an SQL query to report the respective department name and number of 
students majoring in each department for all departments in the 
Department table (even ones with no current students).*/

SELECT department.deptName , count(studentId) FROM exam.department 
LEFT JOIN exam.student ON department.deptId = student.deptId 
GROUP BY deptName;