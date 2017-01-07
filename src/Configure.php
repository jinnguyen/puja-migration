<?php
namespace Puja\Migration;
use Puja\Entity\Entity;

/**
 * This comment (docblock) is copied from Puja\Migration\Configure->getDocblock(); you should do it each time you change the Puja\Migration\Configure->attributes
 * @method string getTable()
 * @method setTable(string $table)
 * @method hasTable()
 * @method unsetTable() // set value to Puja\Migration\Configure::defaults[table] or null
 * @method string getDir()
 * @method setDir(string $dir)
 * @method hasDir()
 * @method unsetDir() // set value to Puja\Migration\Configure::defaults[dir] or null
 * @method boolean getCreateTable()
 * @method setCreateTable(boolean $createTable)
 * @method hasCreateTable()
 * @method unsetCreateTable() // set value to Puja\Migration\Configure::defaults[create_table] or null
 */
class Configure extends Entity
{
	protected $attributes = array(
		'table' => Entity::DATATYPE_STRING,
		'dir' => Entity::DATATYPE_STRING,
		'create_table' => Entity::DATATYPE_BOOLEAN,
	);

	protected $defaults = array(
		'table' => 'puja_migration',
	);
}