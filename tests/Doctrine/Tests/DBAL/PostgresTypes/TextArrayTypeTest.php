<?php
/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 *
 * The unauthorized use of this code outside the boundaries of
 * Opensoft is prohibited.
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

/**
 * Class TextArrayTypeTest
 *
 * Unit tests for the TextArray type
 *
 * @package Doctrine\Tests\DBAL\Types
 */
class TextArrayTypeTest extends \PHPUnit_Framework_TestCase
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
        Type::addType('text_array', "Doctrine\\DBAL\\PostgresTypes\\TextArrayType");
    }

    /**
     * Pre-execution setup
     */
    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('text_array');
    }

    /**
     * Test conversion of PHP array to database value
     *
     * @dataProvider databaseConvertProvider
     */
    public function testTextArrayConvertsToDatabaseValue($serialized, $array)
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
    public function testTextArrayConvertsToPHPValue($serialized, $array)
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('array', $converted);
        $this->assertEquals($array, $converted);
    }

    /**
     * Provider for conversion test values
     *
     * @return array
     */
    public static function databaseConvertProvider()
    {
        return array(
            array('{simple,extended}', array('simple', 'extended'))
        );
    }
}
