<?php
namespace Puja\Migration;
class Configure
{
	protected $cfg;
	public function __construct($cfg)
	{
		$this->cfg = $cfg;
	}
	public function getTable()
	{
		return $this->cfg['table'];
	}
	
	public function getDir()
	{
		return $this->cfg['dir'];
	}
}