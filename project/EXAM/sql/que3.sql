USE exam;

CREATE TABLE `exam`.`actorDirector`(
	`actorId` INT NOT NULL,
    `directorId` INT NOT NULL,
    `timeStamp` INT NOT NULL,
    PRIMARY KEY(`timeStamp`)
);

SELECT * FROM `exam`.`actorDirector`;

INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('1', '1', '0');
INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('1', '1', '1');
INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('1', '1', '2');
INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('1', '2', '3');
INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('1', '2', '4');
INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('2', '1', '5');
INSERT INTO `exam`.`actorDirector` (`actorId`, `directorId`, `timeStamp`) VALUES ('2', '1', '6');


/* Write a SQL query for a report that provides the pairs (actor_id, 
director_id) where the actor has cooperated with the director at least 
three times.*/

SELECT actorId , directorId FROM exam.actorDirector
GROUP BY actorId , directorId
HAVING COUNT(*) >2;