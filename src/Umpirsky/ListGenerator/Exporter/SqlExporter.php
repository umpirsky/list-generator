<?php

namespace Umpirsky\ListGenerator\Exporter;

use Umpirsky\ListGenerator\Exporter\Exporter;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Table;
use Zend\Db\Adapter\Platform;
use Zend\Db\Sql\Insert;

abstract class SqlExporter extends Exporter
{
    const TABLE_NAME = 'list';

    private $connections = [];

    /**
     * {@inheritdoc}
     */
    public function export(array $data)
    {
        return $this->exportCreateTable() . PHP_EOL . $this->exportInsert($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormat()
    {
        return parent::getFormat().'.sql';
    }

    /**
     * Gets SQL driver.
     *
     * @return string
     */
    abstract public function getDriver();

    /**
     * Gets platform.
     *
     * @return \Zend\Db\Adapter\Platform\PlatformInterface
     */
    public function getPlatform()
    {
        switch ($this->getDriver()) {
            case 'pdo_mysql':
                return new Platform\Mysql();
                break;

            case 'pdo_pgsql':
                return new Platform\Postgresql();
                break;

            case 'pdo_sqlite':
                return new Platform\Sqlite();
                break;

            case 'pdo_sqlsrv':
                return new Platform\SqlServer();
                break;

            default:

                throw new \Exception(sprintf('Unknown platform %s.', $this->getPlatform()));
                break;
        }
    }

    /**
     * Exports create table SQL.
     *
     * @return string
     */
    protected function exportCreateTable()
    {
        $table = new Table(self::TABLE_NAME, array(), array(), array(), false, array());
        $table->addColumn('id', 'string', array('length' => 64, 'notnull' => true));
        $table->setPrimaryKey(array('id'));
        $table->addColumn('value', 'string', array('length' => 64));

        $sql = $this->getConnection()
            ->getDatabasePlatform()
            ->getCreateTableSQL($table, AbstractPlatform::CREATE_INDEXES)
        ;

        return array_pop($sql).';'.PHP_EOL;
    }

    /**
     * Exports insert SQL.
     *
     * @param  array  $data
     * @return string
     */
    protected function exportInsert(array $data)
    {
        $insertSql = '';
        $insert = new Insert(self::TABLE_NAME);
        foreach ($data as $id => $value) {
            $insertSql .= @$insert
                ->values(array('id' => $id, 'value' => $value))
                ->getSqlString($this->getPlatform()).';'.PHP_EOL;
        }

        return $insertSql;
    }

    /**
     * DB config matches docker config.
     */
    private function getConnection()
    {
        if (!isset($this->connections[$this->getDriver()])) {
            $this->connections[$this->getDriver()] = DriverManager::getConnection(
                array(
                    'driver' => $this->getDriver(),
                    'host' => str_replace('pdo_', '', $this->getDriver()),
                    'dbname' => 'list',
                    'user' => 'list',
                    'password' => 'list',
                    // 'unix_socket' => '/tmp/mysql.sock',
                )
            );
        }

        return $this->connections[$this->getDriver()];
    }
}
