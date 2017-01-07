<?php
namespace Puja\Migration\DataSource;
use Puja\Migration\Table;
use Puja\Db\Exception;

class Sql extends DataSourceAbstract
{

    /**
     * Removes SQL comments from a string.
     *
     * @param string $sqlString The SQL string to cleanup.
     *
     * @return string The cleaned SQL string.
     *
     * @see http://dev.mysql.com/doc/refman/5.5/en/comments.html
     */
    protected function removeComments()
    {
        $pattern = array(
            '#^\s*\#.*$#m' => '', // sharp
            '#^\s*\-\-\s*?(.*)$#m' => '', // double-dash + space
            '#/\*[^*!]*\*+([^/][^*]*\*+)*/#' => '' // C style
        );

        $this->fileContent = preg_replace(array_keys($pattern), array_values($pattern), $this->fileContent);
    }

    protected function splitQuery()
    {

        // the regex needs a trailing semicolon
        $query = trim ((string) $this->fileContent);

        if ( substr ( $query, -1 ) != ";")
            $query .= ";";

        // i spent 3 days figuring out this line
        preg_match_all( "/(?>[^;']|(''|(?>'([^']|\\')*[^\\\]')".
            "))+;/ixU", $query, $matches, PREG_SET_ORDER );

        $querySplit = array();

        foreach ( $matches as $match )
        {
            // get rid of the trailing semicolon
            $querySplit[] = substr( $match[0], 0, -1 );
        }

        return $querySplit;
    }

    public function run(Table\Migration $table)
    {
        $this->removeComments();
        $queries = $this->splitQuery();

        if (empty($queries)) {
            $table->save($this->fileName);
            return true;
        }

        $adapter = Table\Migration::getWriteAdapter();
        try {
            $adapter->getDriver()->getConnection()->beginTransaction();
            $table->save($this->fileName);
            foreach ($queries as $query) {
                $this->addStament($query);
                $adapter->execute($query);
            }
            $adapter->getDriver()->getConnection()->commit();
        } catch (Exception $e) {
            $adapter->getDriver()->getConnection()->rollback();
            throw new Exception($e->getMessage());
        }
    }

}
