-- SEAAMZ-10330: Automated allocation of Affiliates to Advertiser from sign up page
CREATE TABLE IF NOT EXISTS `hasoffers_conversion_fail` (
  `id_hasoffers_conversion_fail` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method` tinyint(3) unsigned NOT NULL COMMENT '1:api - 2:s2s',
  `data` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `error` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `retry` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:pending; - 2:done;',
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`id_hasoffers_conversion_fail`),
  KEY `method_status` (`method`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;CREATE TABLE IF NOT EXISTS `hasoffers_category_config` (
  `id_hasoffers_category_config` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `fk_customer_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id_hasoffers_category_config`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
insert into hasoffers_conversion_fail(`data`,`method`, `error`) values('data', 'testMethod', 'Error data');
