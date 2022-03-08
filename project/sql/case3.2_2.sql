USE databasequeries3 ;

CREATE TABLE `courses` (
  `student` varchar(45) NOT NULL,
  `class` varchar(45) NOT NULL,
  PRIMARY KEY (`student`,`class`)
);


INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('A', 'Math');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('B', 'English');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('C', 'Math');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('D', 'Biology');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('E', 'Math');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('F', 'Computer');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('G', 'Math');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('H', 'Math');
INSERT INTO `databasequeries3`.`courses` (`student`, `class`) VALUES ('I', 'Math');


/*QUERY 1 : Write an SQL query to report all the classes that have at least five students. Return the result table in any order*/
SELECT  `class`  FROM `databasequeries3`.`courses` group by `class` HAVING COUNT(DISTINCT `student`) >= 5;
