USE databasequeries3;

CREATE TABLE `databasequeries3`.`activity`(
	`playerId` INT NOT NULL,
    `deviceId` INT NOT NULL,
    `eventDate` DATE NOT NULL,
    `gamePlayed` INT NOT NULL DEFAULT 0,
    CONSTRAINT PK_activity PRIMARY KEY(playerId , eventDate)
);

SELECT * FROM`databasequeries3`.`activity`;

INSERT INTO `databasequeries3`.`activity` (`playerId`, `deviceId`, `eventDate`, `gamePlayed`) VALUES ('1', '2', '2016-03-01', '5');
INSERT INTO `databasequeries3`.`activity` (`playerId`, `deviceId`, `eventDate`, `gamePlayed`) VALUES ('1', '2', '2016-05-02', '5');
INSERT INTO `databasequeries3`.`activity` (`playerId`, `deviceId`, `eventDate`, `gamePlayed`) VALUES ('2', '3', '2017-06-25', '1');
INSERT INTO `databasequeries3`.`activity` (`playerId`, `deviceId`, `eventDate`, `gamePlayed`) VALUES ('3', '1', '2016-03-02', '0');
INSERT INTO `databasequeries3`.`activity` (`playerId`, `deviceId`, `eventDate`, `gamePlayed`) VALUES ('3', '4', '2018-07-03', '5');


/* Question 1: Write an SQL query to report the first login date for each player. Return the result table in any order */
SELECT playerId , min(eventDate) from activity
GROUP BY playerId;

/* Write an SQL query to report the device that is first logged in for each player. Return the result table in any order. */
SELECT DISTINCT playerId, deviceId from activity
WHERE(SELECT min(eventDate) from activity)
GROUP BY playerId;

/*
SELECT `player_id`, `device_id` FROM `testcases`.`activity`  as ac1 
WHERE `event_date` =  ( SELECT min(`event_date`) FROM `testcases`.`activity` AS ac2 
WHERE ac1.player_id = ac2.player_id GROUP BY  `player_id`)
*/

/*Write an SQL query to report for each player and date, how many games played so far by the player. 
That is, the total number of games played by the player until that date. Check the example for clarity. Return the result table in any order.*/

SELECT playerId , eventDate , sum(gamePlayed) from activity
where (select playerId order by eventDate)
group by playerId;