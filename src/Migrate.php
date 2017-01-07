<?php
namespace Puja\Migration;
use Puja\FileSystem\Folder;

class Migrate
{
	protected $config;
	protected $table;
	public function __construct($config)
	{
		$this->config = new Configure($config);

		$this->table = new Table\Migration($this->config->getTable());
		if ($this->config->getCreateTable()) {
			Table\Migration::getWriteAdapter()->execute('
                CREATE TABLE IF NOT EXISTS ' . $this->config->getTable() . '(
                    `file_name` VARCHAR(255),
                    `file_data` text,
                    `timestamp` DATETIME,
                PRIMARY KEY (`file_name`))
            ');
		}

		$this->process();
	}
	
	protected function process()
	{
		$folder = new Folder($this->config->getDir());
		$childFiles = $folder->getChildFiles();

		$files = array();
		foreach ($childFiles as $file) {
			$files[$file] = basename($file);
		}

		asort($files, SORT_NUMERIC);
		$migratedFiles = array();
		$result = $this->table->getDataByFileNames($files);
		foreach ($result as $rs) {
			$migratedFiles[$rs['file_name']] = true;
		}
		
		DataSource\DataSourceAbstract::showMessage('== START DB MIGRATION');

		foreach ($files as $file => $fileName) {
			if (array_key_exists($fileName, $migratedFiles)) {
				continue;
			}

			DataSource\DataSourceAbstract::showMessage(
				'=========================================================================================' . PHP_EOL .
				'File: ' . $file . PHP_EOL .
				'========================================================================================='
			);

			if (substr($file, -4) === '.php') {
				$dataSource = new DataSource\Php($file);
			} else {
				$dataSource = new DataSource\Sql($file);
			}

			$dataSource->run($this->table);
			
		}

		DataSource\DataSourceAbstract::showMessage('== FINISH DB MIGRATION');

		
		
	}
}