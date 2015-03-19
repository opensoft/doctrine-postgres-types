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
 * Class TsvectorTest
 *
 * Unit tests for the TextArray type
 *
 * @package Doctrine\Tests\DBAL\Types
 */
class TsvectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\TsvectorType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    /**
     * Pre-instantiation setup
     */
    public static function setUpBeforeClass()
    {
        Type::addType('tsvector', "Doctrine\\DBAL\\PostgresTypes\\TsvectorType");
    }

    /**
     * Pre-execution setup
     */
    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('tsvector');
    }

    /**
     * Test conversion of PHP array to database value
     */
    public function testTsvectorConvertsToDatabaseValue()
    {
        $this->assertInternalType('string', $this->_type->convertToDatabaseValue(array('simple', 'extended'), $this->_platform));
    }

    /**
     * Test conversion of database value to PHP array
     */
    public function testTsvectorConvertsToPHPValue()
    {
        $this->assertInternalType('array', $this->_type->convertToPHPValue('ts:simple ts:extended', $this->_platform));
    }
}
