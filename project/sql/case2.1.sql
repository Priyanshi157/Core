CREATE SCHEMA Weather;
USE weather;

/* CASE STUDY 1 */
CREATE TABLE weather(
    `weatherId` INT NOT NULL AUTO_INCREMENT,
    `recordDate` DATE NOT NULL,
    `temperature` INT NOT NULL,
    PRIMARY KEY(weatherId)
);

INSERT INTO `Weather`.`weather`(`recordDate`,`temperature`) VALUES ('2022-01-01','10');
INSERT INTO `Weather`.`weather`(`recordDate`,`temperature`) VALUES ('2022-01-02','25');
INSERT INTO `Weather`.`weather`(`recordDate`,`temperature`) VALUES ('2022-01-03','20');
INSERT INTO `Weather`.`weather`(`recordDate`,`temperature`) VALUES ('2022-01-04','30');

/* Write an SQL query to find all dates' Id with higher temperatures compared to its previous dates (yesterday*/
SELECT w1.weatherId FROM weather w1, weather w2 
WHERE w1.temperature > w2.temperature AND TO_DAYS(w1.recordDate)-TO_DAYS(w2.recordDate)=1;
