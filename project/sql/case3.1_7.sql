/*Create a database schema for student grade system. It contains student data and their grade of each subject based on the different semester*/
CREATE SCHEMA `gradeSystem`;

USE `gradeSystem`;

CREATE TABLE `gradeSystem`.`student`(
	`studentId` INT NOT NULL AUTO_INCREMENT,
    `rollNo` INT NOT NULL,
    `firstName` VARCHAR(64) NOT NULL,
    `middleName` VARCHAR(64) NOT NULL,
	`lastName` VARCHAR(64) NOT NULL,
    `standard` INT NOT NULL,
    `division` CHAR NOT NULL,
    `addressline1` VARCHAR(512),
    `addressline2` VARCHAR(512),
    `city` VARCHAR(128) NOT NULL,
    `pincode` VARCHAR(8) NOT NULL,
    PRIMARY KEY(`studentId`)
);

CREATE TABLE `gradeSystem`.`subject`(
	`subjectId` INT NOT NULL,
    `subjectName` VARCHAR(128) NOT NULL,
    `standard` INT NOT NULL,
    PRIMARY KEY(`subjectId`)
);

CREATE TABLE `gradeSystem`.`faculty`(
	`facultyId` INT NOT NULL AUTO_INCREMENT,
    `facultyName` VARCHAR(64) NOT NULL,
    `subjectId` INT NOT NULL,
    `userName` VARCHAR(64) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `createdAt` DATETIME NOT NULL,
    PRIMARY KEY(`facultyId`),
    FOREIGN KEY(`subjectId`) REFERENCES `subject`(`subjectId`)
);

CREATE TABLE `gradeSystem`.`studentGrade`(
	`gradeId` INT NOT NULL AUTO_INCREMENT,
    `studentId` INT NOT NULL,
    `subjectId` INT NOT NULL,
    `facultyId` INT NOT NULL,
    `grade` CHAR NOT NULL,
    `remark` VARCHAR(1024),
    PRIMARY KEY(`gradeId`),
    FOREIGN KEY(`studentId`) REFERENCES `student`(`studentId`),
    FOREIGN KEY(`subjectId`) REFERENCES `subject`(`subjectId`),
    FOREIGN KEY(`facultyId`) REFERENCES `faculty`(`facultyId`)
 );
 
CREATE TABLE `gradeSystem`.`facultySubject`(
	`facultysubId` INT NOT NULL AUTO_INCREMENT,
    `facultyId` INT NOT NULL,
    `subjectId` INT NOT NULL,
    PRIMARY KEY(`facultysubId`),
    FOREIGN KEY(`facultyId`) REFERENCES `faculty`(`facultyId`),
    FOREIGN KEY(`subjectId`) REFERENCES `subject`(`subjectId`)
 );
/*
student table  : id,rollno,fname,mname,lname, std,div,ADD1,ADD2,CITY,PINCODE
student grade table - grade id , student id(fk) , subjectid , faculty id , grade , remark
subject table - sub id , sub name , std 
faculty table - faculty id , faculty name , sub id(fk) , uname, pwd , createdat
faculty subject table - facultysub id , facultyid , sub id
*/