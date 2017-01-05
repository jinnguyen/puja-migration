<?php
include '../../vendor/autoload.php';


use Puja\Migration\Migrate;
new Migrate(array('table' => 'puja_migration', 'dir' => __DIR__ . '/migrations/'));


