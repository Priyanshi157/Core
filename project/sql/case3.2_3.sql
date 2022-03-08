USE databasequeries3;

CREATE TABLE `databasequeries3`.`world` (
  `name` VARCHAR(32) NOT NULL,
  `continent` VARCHAR(45) NOT NULL,
  `area` INT NOT NULL,
  `gdp` DOUBLE NOT NULL,
  `population` INT  NOT NULL,
  PRIMARY KEY (`name`));


INSERT INTO `databasequeries3`.`world`(`name`,`continent`,`area`,`population`,`gdp`)
VALUES('Afghanistan','Asia','652230','25500100','20343000000');
INSERT INTO `databasequeries3`.`world`(`name`,`continent`,`area`,`population`,`gdp`)
VALUES('Albania','Europe','28748','2831741','12960000000');
INSERT INTO `databasequeries3`.`world`(`name`,`continent`,`area`,`population`,`gdp`)
VALUES('Algeria','Africa','2381741','37100000','188681000000');
INSERT INTO `databasequeries3`.`world`(`name`,`continent`,`area`,`population`,`gdp`)
VALUES('Andorra','Europe','468','78115','3712000000');
INSERT INTO `databasequeries3`.`world`(`name`,`continent`,`area`,`population`,`gdp`)
VALUES('Angola','Africa','1246700','20609294','100990000000');

SELECT `name`, `population`, `area` FROM `databasequeries3`.`world` WHERE `area` > 3000000 OR `population` > 25000000;