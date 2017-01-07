<?php
namespace Puja\Migration\DataSource;
abstract class DataSourceAbstract
{
    protected $fileContent;
    protected $file;
    protected $fileName;
    public function __construct($file)
    {
        $this->fileContent = file_get_contents($file);
        $this->file = $file;
        $this->fileName = basename($file);
    }

    public static function showMessage($message)
    {
        echo PHP_EOL . $message . PHP_EOL;
    }

    public function addStament($stm)
    {
        self::showMessage($stm);
    }

    abstract public function run(\Puja\Migration\Table\Migration $table);
}