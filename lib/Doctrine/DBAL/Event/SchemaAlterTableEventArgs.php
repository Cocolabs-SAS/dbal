<?php

namespace Doctrine\DBAL\Event;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Schema\TableDiff;
use function array_merge;
use function is_array;

/**
 * Event Arguments used when SQL queries for creating tables are generated inside Doctrine\DBAL\Platform\*Platform.
 *
 * @link   www.doctrine-project.org
 */
class SchemaAlterTableEventArgs extends SchemaEventArgs
{
    /** @var TableDiff */
    private $_tableDiff;

    /** @var AbstractPlatform */
    private $_platform;

    /** @var string[] */
    private $_sql = [];

    public function __construct(TableDiff $tableDiff, AbstractPlatform $platform)
    {
        $this->_tableDiff = $tableDiff;
        $this->_platform  = $platform;
    }

    /**
     * @return TableDiff
     */
    public function getTableDiff()
    {
        return $this->_tableDiff;
    }

    /**
     * @return AbstractPlatform
     */
    public function getPlatform()
    {
        return $this->_platform;
    }

    /**
     * @param string|string[] $sql
     *
     * @return \Doctrine\DBAL\Event\SchemaAlterTableEventArgs
     */
    public function addSql($sql)
    {
        if (is_array($sql)) {
            $this->_sql = array_merge($this->_sql, $sql);
        } else {
            $this->_sql[] = $sql;
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public function getSql()
    {
        return $this->_sql;
    }
}
