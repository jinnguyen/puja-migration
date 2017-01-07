<?php
namespace Puja\Migration\Table;
class Migration extends \Puja\Db\Table
{
    public function save($fileName, $fileData = null)
    {
        $this->insert(array(
            'file_name' => $fileName,
            'file_data' => $fileData,
            'timestamp__exact' => 'NOW()'
        ));
    }

    public function getDataByFileNames($fileNames = array())
    {
        return $this->findByCriteria('file_name IN ("' . implode('","', $fileNames) . '")');
    }
}