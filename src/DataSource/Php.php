<?php
namespace Puja\Migration\DataSource;
use Puja\Migration\Table;

class Php extends DataSourceAbstract
{
    public function run(Table\Migration $table)
    {
        $adapter = Table\Migration::getWriteAdapter();
        try {
            $adapter->getDriver()->getConnection()->beginTransaction();
            $table->save($this->fileName);
            include $this->file;
            $adapter->getDriver()->getConnection()->commit();
        } catch (Exception $e) {
            $adapter->getDriver()->getConnection()->rollback();
            throw new Exception($e->getMessage());
        }
    }
}
