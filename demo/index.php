<?php
include __DIR__ . '/../vendor/autoload.php';
use Puja\Db\Adapter;
$configures = array(
    'write_adapter_name' => 'master',
    'adapters' => array(
        'default' => array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '123',
            'dbname' => 'fwcms',
            'charset' => 'utf8',
        ),
        'master' => array(
            'host' => 'localhost',
            'username' => 'root',
            'password' => '123',
            'dbname' => 'fwcms',
            'charset' => 'utf8',
        )
    )
);

new Adapter($configures);

use Puja\Migration\Migrate;
new Migrate(array('table' => 'puja_migration', 'dir' => __DIR__ . '/migrations/', 'create_table' => true));


