<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

/**
 * Doctrine\Tests\DBAL\Types\TsqueryTest.
 *
 * Unit tests for the Tsquery type
 *
 * @author Ivan Molchanov <ivan.molchanov@opensoftdev.ru>
 */
class TsqueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\TsqueryType
     */
    protected $type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $platform;

    /**
     * Pre-instantiation setup.
     */
    public static function setUpBeforeClass()
    {
        Type::addType('tsquery', 'Doctrine\\DBAL\\PostgresTypes\\TsqueryType');
    }

    /**
     * Pre-execution setup.
     */
    protected function setUp()
    {
        $this->platform = new PostgreSqlPlatform();
        $this->type = Type::getType('tsquery');
    }

    /**
     * Test conversion to database value.
     */
    public function testConvertToDatabaseValueSQL()
    {
        $this->assertEquals('to_tsquery(test)', $this->type->convertToDatabaseValueSQL('test', $this->platform));
    }
}
