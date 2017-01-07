<?php
$adapter = \Puja\Db\Table::getWriteAdapter();
$this->addStament('INSERT migration_by_php_file ');
$adapter->execute('insert into configuration (config_key, config_value) values("migration_by_php_file", "sample_value")');