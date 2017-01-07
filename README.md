# puja-migration
Puja-Migration is a database migration php library, supports both file sql and php

<strong>Install:</strong>
<pre>composer require jinnguyen/puja-migration</pre>

<strong>Usage:</strong>
<pre>
include '/path/to/vendor/autoload.php';
use Puja\Migration\Migrate;</pre>

<strong>Example:</strong>
<pre>
// Configure DB
use Puja\Db\Adapter;

new \Puja\Db\Adapter(array(
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
));

// configure migration
new \Puja\Migration\Migrate(array(
    'table' => 'puja_migration', // db table name that store migration tracking information
    'dir' => __DIR__ . '/migrations/', // the folder store migration files
    'create_table' => true, // if true, the query "CREATE TABLE &lt;table&gt;" will run, should enable at the first time and disable from second time.
));
</pre>



<strong>Note*</strong>
<p>1. THE ORDER OF MIGRATION FILES ARE VERY IMPORTANT</p>
<br>So pls follow the file name conversation:
    - The name should begin by a numeric, e.g: 0-launched-project.sql, 1-update.sql, 2-data-fix.php,....<br />

    As above example,  0-launched-project.sql is  run first then 1-update.sql then 2-data-fix.php

<p>2. The php files are not show log message as default, if you want to show the log message you can use $this->addStament('Message'); // check in demo/3.php
