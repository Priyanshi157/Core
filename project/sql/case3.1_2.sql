USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`cinema`(
	`id` INT NOT NULL AUTO_INCREMENT,
	`movie` VARCHAR(256) NOT NULL,
    `description` VARCHAR(2048) NOT NULL,
    `rating` FLOAT(3,2) NOT NULL,
    PRIMARY KEY(`id`)
);

SELECT * FROM `DatabaseQueries3`.`cinema`;

INSERT INTO `DatabaseQueries3`.`cinema` (`id`, `movie`, `description`, `rating`) VALUES ('1', 'War', 'great 3D', '8.9');
INSERT INTO `DatabaseQueries3`.`cinema` (`id`, `movie`, `description`, `rating`) VALUES ('2', 'Science', 'fiction', '8.5');
INSERT INTO `DatabaseQueries3`.`cinema` (`id`, `movie`, `description`, `rating`) VALUES ('3', 'irish', 'boring', '6.2');
INSERT INTO `DatabaseQueries3`.`cinema` (`id`, `movie`, `description`, `rating`) VALUES ('4', 'Ice song', 'Fantacy', '8.6');
INSERT INTO `DatabaseQueries3`.`cinema` (`id`, `movie`, `description`, `rating`) VALUES ('5', 'House card', 'interesting', '9.1');

/* 2. Write an SQL query to report the movies with an odd-numbered ID and a description that is not "boring".  */
SELECT * FROM `DatabaseQueries3`.`cinema` 
WHERE cinema.description <> 'boring'
AND mod(id,2) <> 0;
