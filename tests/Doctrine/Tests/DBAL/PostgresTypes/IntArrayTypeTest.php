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
 * Class IntArrayTypeTest
 *
 * Unit tests for the IntArray type
 *
 * @package Doctrine\Tests\DBAL\Types
 */
class IntArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\IntArrayType
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
        Type::addType('int_array', "Doctrine\\DBAL\\PostgresTypes\\IntArrayType");
    }

    /**
     * Pre-execution setup
     */
    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('int_array');
    }

    /**
     * Test conversion of PHP array to database value
     *
     * @dataProvider databaseConvertProvider
     */
    public function testIntArrayConvertsToDatabaseValue($serialized, $array)
    {
        $converted = $this->_type->convertToDatabaseValue($array, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($serialized, $converted);
    }

    /**
     * Test conversion of database value to PHP array
     *
     * @dataProvider databaseConvertProvider
     */
    public function testIntArrayConvertsToPHPValue($serialized, $array)
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('array', $converted);
        $this->assertEquals($array, $converted);

        if (sizeof($converted) > 0)
        {
            $this->assertInternalType("int", reset($converted));
        }
    }

    /**
     * Provider for conversion test values
     *
     * @return array
     */
    public static function databaseConvertProvider()
    {
        return array(
            array('{1,2,3}', array(1,2,3)),
            array('{}', array())
        );
    }
}
