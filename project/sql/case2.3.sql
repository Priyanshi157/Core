/* CASE STUDY 3 */
CREATE TABLE employee(
	`employeeId` INT NOT NULL AUTO_INCREMENT,
    `salary` INT(8) NOT NULL,
    PRIMARY KEY(employeeId)
);

INSERT INTO `weather`.`employee` (`salary`) VALUES ('100');
INSERT INTO `weather`.`employee` (`salary`) VALUES ('200');
INSERT INTO `weather`.`employee` (`salary`) VALUES ('300');
INSERT INTO `weather`.`employee` (`salary`) VALUES ('250');
INSERT INTO `weather`.`employee` (`salary`) VALUES ('600');
INSERT INTO `weather`.`employee` (`salary`) VALUES ('400');

SELECT employeeId,salary FROM `weather`.`employee` 
ORDER BY salary DESC;

/* N-1 = 4-1 */
SELECT employeeId,salary FROM employee e1 WHERE
        0 = (SELECT COUNT(DISTINCT salary) FROM employee e2 WHERE e2.salary > e1.salary);