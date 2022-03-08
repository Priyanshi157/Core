/* Write an SQL query to create index on the email column */
USE DatabaseQueries3;

CREATE TABLE `DatabaseQueries3`.`mail`(
	`id` INT NOT NULL AUTO_INCREMENT,
    `mail` VARCHAR(128),
    PRIMARY KEY(`id`)
);

CREATE INDEX `email`
ON `mail` (`mail`);