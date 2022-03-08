USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`salary`(
    `salaryId` INT NOT NULL AUTO_INCREMENT,
    `empName` VARCHAR(64),
    `empSex` ENUM('M','F'),
    `salary` BIGINT,
    PRIMARY KEY(`salaryId`)
);

SELECT * FROM `DatabaseQueries3`.`salary`;

INSERT INTO `DatabaseQueries3`.`salary` (`salaryId`, `empName`, `empSex`, `salary`) VALUES ('1', 'A', 'M', '20000');
INSERT INTO `DatabaseQueries3`.`salary` (`salaryId`, `empName`, `empSex`, `salary`) VALUES ('2', 'B', 'F', '18000');
INSERT INTO `DatabaseQueries3`.`salary` (`salaryId`, `empName`, `empSex`, `salary`) VALUES ('3', 'C', 'F', '22000');
INSERT INTO `DatabaseQueries3`.`salary` (`salaryId`, `empName`, `empSex`, `salary`) VALUES ('4', 'D', 'M', '25000');

/*3. Write an SQL query to swap all 'f' and 'm' values (i.e., change all 'f' values to 'm' and vice versa) 
with a single update statement and no intermediate temporary tables.Note that you must write a single update statement, 
do not write any select statement for this problem.
*/

update Salary set empSex = if(empSex='m' , 'f','m');

SELECT * FROM `DatabaseQueries3`.`salary`;