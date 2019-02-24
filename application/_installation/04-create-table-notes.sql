CREATE TABLE IF NOT EXISTS `huge`.`userextension` (
`userid` VARCHAR(18) NOT NULL,
`address1` VARCHAR(500),
`address2` VARCHAR(500),
`state` VARCHAR(50),
`city` VARCHAR(100),
`zipcode` char(5),
`fullname` VARCHAR(5000),
`stripeid` VARCHAR(50),
`balance` DECIMAL(10,2) DEFAULT 0,
`totalpay` DECIMAL(10,2) DEFAULT 0,
`totaljobs` int(6) DEFAULT 0,
`3dprints` int(6) DEFAULT 0,
`weld` int(6)DEFAULT 0,
`cnc` int(6) DEFAULT 0,
`solder` int(6) DEFAULT 0,
`phone` VARCHAR(25)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Users table Extension';

CREATE TABLE IF NOT EXISTS `huge`.`qualifications` (
`userid` int(11) NOT NULL,
`weld` tinyint(1) NOT NULL DEFAULT '0',
`3dprint` tinyint(1) NOT NULL DEFAULT '0',
`cnc` tinyint(1) NOT NULL DEFAULT '0',
`solder` tinyint(1) NOT NULL DEFAULT '0',
`laser` tinyint(1) NOT NULL DEFAULT '0',
`plasma` tinyint(1) NOT NULL DEFAULT '0'  
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Users Qualifactions';

CREATE TABLE IF NOT EXISTS `huge`.`3dprint` (
`userid` int(11) NOT NULL,
`printername` VARCHAR(500),
`quality` tinyint(1) NOT NULL DEFAULT '1',
`pla` tinyint(1) NOT NULL DEFAULT '1',
`abs` tinyint(1) NOT NULL DEFAULT '0',
`extruders` tinyint(1) NOT NULL DEFAULT '1',
`flex` tinyint(1) NOT NULL DEFAULT '0',
`other` VARCHAR(50)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Users 3d printer Rating';

CREATE TABLE IF NOT EXISTS `huge`.`jobs` (
`job_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
`active` tinyint(1) NOT NULL DEFAULT '0',
`createid` int(11) NOT NULL,
`doid` int(11) NOT NULL,
`3dprint` tinyint(1) NOT NULL DEFAULT '0',
`weld` tinyint(1) NOT NULL DEFAULT '0',
`cnc` tinyint(1) NOT NULL DEFAULT '0',
`laser` tinyint(1) NOT NULL DEFAULT '0',
`description` VARCHAR(5000) NOT NULL,
`files` VARCHAR(25) NOT NULL ,
`pay` DECIMAL(8,2),
`reviewed` tinyint(1) NOT NULL DEFAULT '0',
`material` VARCHAR(50),
 PRIMARY KEY (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Tasks Table';

CREATE TABLE IF NOT EXISTS `huge`.`reviews` (
`userid` int(11) NOT NULL,
`title` VARCHAR(500) NOT NULL,
`body` VARCHAR(6000) NOT NULL,
`stars` tinyint(1) NOT NULL DEFAULT '1',
`process` tinyint(1) NOT NULL DEFAULT '0',
`timelyness` tinyint(1) NOT NULL DEFAULT '1',
`quality` tinyint(1) NOT NULL DEFAULT '0',
`communication` tinyint(1) NOT NULL DEFAULT '0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='account reviews';
