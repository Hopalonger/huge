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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user notes';
