<?php
namespace Puja\Migration;


use Puja\FileSystem\Folder;

class Migrate
{
	protected $config;
	public function __construct($config)
	{
		$this->config = new Configure($config);
		$this->loadFiles();
	}
	
	protected function loadFiles()
	{
		$folder = new Folder($this->config->getDir());
		
	}
}