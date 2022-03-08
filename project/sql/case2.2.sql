/* CASE STUDY 2 */
CREATE TABLE logs(
	`logid` INT NOT NULL AUTO_INCREMENT,
    `number` INT NOT NULL,
    PRIMARY KEY(logID)
);

INSERT INTO `weather`.`logs` (`number`) VALUES ('1');
INSERT INTO `weather`.`logs` (`number`) VALUES ('1');
INSERT INTO `weather`.`logs` (`number`) VALUES ('1');
INSERT INTO `weather`.`logs` (`number`) VALUES ('2');
INSERT INTO `weather`.`logs` (`number`) VALUES ('2');
INSERT INTO `weather`.`logs` (`number`) VALUES ('1');
INSERT INTO `weather`.`logs` (`number`) VALUES ('2');
INSERT INTO `weather`.`logs` (`number`) VALUES ('1');

/* Write an SQL query to find all numbers that appear at least three times consecutively */
SELECT DISTINCT l1.number AS ConsecutiveNums FROM logs l1, logs l2, logs l3 
WHERE l1.logId=l2.logId-1 and l2.logId=l3.logId-1 
AND l1.number=l2.number and l2.number = l3.number;
