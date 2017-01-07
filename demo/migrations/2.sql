CREATE TABLE IF NOT EXISTS `configuration` (
  `config_key` VARCHAR (255) NOT NULL,
  `config_value` VARCHAR (255),
  PRIMARY KEY (`config_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

