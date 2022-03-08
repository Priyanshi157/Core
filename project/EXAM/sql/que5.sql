USE exam;

CREATE TABLE `exam`.`enrollments`(
	`id` INT NOT NULL AUTO_INCREMENT,
	`studentsId` INT NOT NULL,
    `courseId` INT NOT NULL,
    `grade` INT NOT NULL,
    PRIMARY KEY(`id`)
);

SELECT *FROM `exam`.`enrollments`;

INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('2', '2', '95');
INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('2', '3', '95');
INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('1', '1', '90');
INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('1', '2', '99');
INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('3', '1', '80');
INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('3', '2', '75');
INSERT INTO `exam`.`enrollments` (`studentsId`, `courseId`, `grade`) VALUES ('3', '3', '82');

/*Write a SQL query to find the highest grade with its corresponding course 
for each student. In case of a tie, you should find the course with the 
smallest course_id.
Return the result table ordered by student_id in ascending order.*/

SELECT studentsId , MAX(grade) FROM enrollments
GROUP BY studentsId
ORDER BY studentsId ASC;