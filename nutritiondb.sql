-- #CREATE TABLE SYNTAX FOR NUTRITIONDB
-- #passed off as a deliverable for COMP 523 Software Engineering

-- +-----------------------+
-- | Tables_in_nutritiondb |
-- +-----------------------+
-- | complete_label        |
-- | config                |
-- | current_label         |
-- | label                 |
-- | logged_in_user        |
-- | new_label             |
-- | submission            |
-- | user                  |
-- +-----------------------+

CREATE TABLE `complete_label` (
  `upc` bigint(12) unsigned zerofill NOT NULL,
  `servsize` int(11) DEFAULT NULL,
  `servunit` varchar(11) DEFAULT NULL,
  `volquantity` int(11) DEFAULT NULL,
  `volunit` varchar(11) DEFAULT NULL,
  `servcontainer` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `caloriesfat` int(11) DEFAULT NULL,
  `totalfatg` decimal(3,1) DEFAULT NULL,
  `totalfatdv` int(11) DEFAULT NULL,
  `saturatedfatg` decimal(3,1) DEFAULT NULL,
  `saturatedfatdv` int(11) DEFAULT NULL,
  `transfatg` decimal(3,1) DEFAULT NULL,
  `polyunsatfat` decimal(3,1) DEFAULT NULL,
  `monounsatfat` decimal(3,1) DEFAULT NULL,
  `cholesterolmg` int(11) DEFAULT NULL,
  `cholesteroldv` int(11) DEFAULT NULL,
  `sodiummg` int(11) DEFAULT NULL,
  `sodiumdv` int(11) DEFAULT NULL,
  `potassiummg` int(11) DEFAULT NULL,
  `potassiumdv` int(11) DEFAULT NULL,
  `totalcarbg` int(11) DEFAULT NULL,
  `totalcarbdv` int(11) DEFAULT NULL,
  `dietaryfiberg` int(11) DEFAULT NULL,
  `dietaryfiberdv` int(11) DEFAULT NULL,
  `sugarsg` int(11) DEFAULT NULL,
  `sugarsalcoholg` int(11) DEFAULT NULL,
  `othercarbg` int(11) DEFAULT NULL,
  `proteing` int(11) DEFAULT NULL,
  `calciumdv` int(11) DEFAULT NULL,
  `irondv` int(11) DEFAULT NULL,
  `vitaminadv` int(11) DEFAULT NULL,
  `vitamincdv` int(11) DEFAULT NULL,
  `vitaminddv` int(11) DEFAULT NULL,
  `vitaminedv` int(11) DEFAULT NULL,
  `vitaminb6dv` int(11) DEFAULT NULL,
  `vitaminb12dv` int(11) DEFAULT NULL,
  `thiamindv` int(11) DEFAULT NULL,
  `riboflavindv` int(11) DEFAULT NULL,
  `otherinfo` int(11) DEFAULT NULL,
  `extrainfo` int(11) DEFAULT NULL,
  PRIMARY KEY (`upc`)
);

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `current_label` (
  `upc` bigint(12) unsigned zerofill NOT NULL,
  `servsize` int(11) DEFAULT NULL,
  `servunit` varchar(11) DEFAULT NULL,
  `volquantity` int(11) DEFAULT NULL,
  `volunit` varchar(11) DEFAULT NULL,
  `servcontainer` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `caloriesfat` int(11) DEFAULT NULL,
  `totalfatg` decimal(3,1) DEFAULT NULL,
  `totalfatdv` int(11) DEFAULT NULL,
  `saturatedfatg` decimal(3,1) DEFAULT NULL,
  `saturatedfatdv` int(11) DEFAULT NULL,
  `transfatg` decimal(3,1) DEFAULT NULL,
  `polyunsatfat` decimal(3,1) DEFAULT NULL,
  `monounsatfat` decimal(3,1) DEFAULT NULL,
  `cholesterolmg` int(11) DEFAULT NULL,
  `cholesteroldv` int(11) DEFAULT NULL,
  `sodiummg` int(11) DEFAULT NULL,
  `sodiumdv` int(11) DEFAULT NULL,
  `potassiummg` int(11) DEFAULT NULL,
  `potassiumdv` int(11) DEFAULT NULL,
  `totalcarbg` int(11) DEFAULT NULL,
  `totalcarbdv` int(11) DEFAULT NULL,
  `dietaryfiberg` int(11) DEFAULT NULL,
  `dietaryfiberdv` int(11) DEFAULT NULL,
  `sugarsg` int(11) DEFAULT NULL,
  `sugarsalcoholg` int(11) DEFAULT NULL,
  `othercarbg` int(11) DEFAULT NULL,
  `proteing` int(11) DEFAULT NULL,
  `calciumdv` int(11) DEFAULT NULL,
  `irondv` int(11) DEFAULT NULL,
  `vitaminadv` int(11) DEFAULT NULL,
  `vitamincdv` int(11) DEFAULT NULL,
  `vitaminddv` int(11) DEFAULT NULL,
  `vitaminedv` int(11) DEFAULT NULL,
  `vitaminb6dv` int(11) DEFAULT NULL,
  `vitaminb12dv` int(11) DEFAULT NULL,
  `thiamindv` int(11) DEFAULT NULL,
  `riboflavindv` int(11) DEFAULT NULL,
  `otherinfo` int(11) DEFAULT NULL,
  `extrainfo` int(11) DEFAULT NULL,
  PRIMARY KEY (`upc`)
);

CREATE TABLE `label` (
  `upc` int(11) NOT NULL,
  `frontimg` varchar(50) NOT NULL,
  `labelimg` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`upc`)
);

CREATE TABLE `logged_in_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `token` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `new_label` (
  `upc` bigint(12) unsigned zerofill NOT NULL,
  `servsize` int(11) DEFAULT NULL,
  `servunit` varchar(11) DEFAULT NULL,
  `volquantity` int(11) DEFAULT NULL,
  `volunit` varchar(11) DEFAULT NULL,
  `servcontainer` int(11) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `caloriesfat` int(11) DEFAULT NULL,
  `totalfatg` decimal(3,1) DEFAULT NULL,
  `totalfatdv` int(11) DEFAULT NULL,
  `saturatedfatg` decimal(3,1) DEFAULT NULL,
  `saturatedfatdv` int(11) DEFAULT NULL,
  `transfatg` decimal(3,1) DEFAULT NULL,
  `polyunsatfat` decimal(3,1) DEFAULT NULL,
  `monounsatfat` decimal(3,1) DEFAULT NULL,
  `cholesterolmg` int(11) DEFAULT NULL,
  `cholesteroldv` int(11) DEFAULT NULL,
  `sodiummg` int(11) DEFAULT NULL,
  `sodiumdv` int(11) DEFAULT NULL,
  `potassiummg` int(11) DEFAULT NULL,
  `potassiumdv` int(11) DEFAULT NULL,
  `totalcarbg` int(11) DEFAULT NULL,
  `totalcarbdv` int(11) DEFAULT NULL,
  `dietaryfiberg` int(11) DEFAULT NULL,
  `dietaryfiberdv` int(11) DEFAULT NULL,
  `sugarsg` int(11) DEFAULT NULL,
  `sugarsalcoholg` int(11) DEFAULT NULL,
  `othercarbg` int(11) DEFAULT NULL,
  `proteing` int(11) DEFAULT NULL,
  `calciumdv` int(11) DEFAULT NULL,
  `irondv` int(11) DEFAULT NULL,
  `vitaminadv` int(11) DEFAULT NULL,
  `vitamincdv` int(11) DEFAULT NULL,
  `vitaminddv` int(11) DEFAULT NULL,
  `vitaminedv` int(11) DEFAULT NULL,
  `vitaminb6dv` int(11) DEFAULT NULL,
  `vitaminb12dv` int(11) DEFAULT NULL,
  `thiamindv` int(11) DEFAULT NULL,
  `riboflavindv` int(11) DEFAULT NULL,
  `otherinfo` int(11) DEFAULT NULL,
  `extrainfo` int(11) DEFAULT NULL,
  PRIMARY KEY (`upc`)
);

CREATE TABLE `submission` (
  `submission_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `upc` bigint(12) unsigned zerofill NOT NULL,
  `column_name` varchar(25) NOT NULL,
  `column_value` varchar(25) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`submission_id`)
);

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(15) NOT NULL,
  `last` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password_digest` varchar(200) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `verification_code` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `verified` int(1) DEFAULT NULL,
  `date_created` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
);

INSERT into user VALUES(
  0, 
  'admin', 
  'admin', 
  'admin', 
  '5d438cfe951ea88e079c2d11165e7bd9305401dc7013bbcb101087e7e441d17877239a64ce293e41a4a466b9fea4083603b6384b878bdb44fe3e8bdf9e745d2e',
  '1',
  'hpvsnk1828fqzis5gn90gr550o7wjwrhuwkar6i5isjferb',
  'admin',
  '1', 
  '2013-04-18'
);