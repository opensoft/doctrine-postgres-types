<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

/**
 * @author Evgeny Kukharik <jonegkk9@gmail.com>
 */
class MacAddrTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\InetType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    /**
     * Pre-instantiation setup.
     */
    public static function setUpBeforeClass()
    {
        Type::addType('macaaddr', 'Doctrine\\DBAL\\PostgresTypes\\MacAddrType');
    }

    /**
     * Pre-execution setup.
     */
    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('macaaddr');
    }

    /**
     * Test conversion of PHP array to database value.
     *
     * @dataProvider databaseConvertProvider
     */
    public function testMacAddrConvertsToDatabaseValue($serialized, $phpValueToConvert)
    {
        $converted = $this->_type->convertToDatabaseValue($phpValueToConvert, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($serialized, $converted);
    }

    /**
     * Test conversion of database value to PHP array.
     *
     * @dataProvider databaseConvertProvider
     */
    public function testMacAddrConvertsToPHPValue($serialized, $databaseValueToConvert)
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($databaseValueToConvert, $converted);
    }

    /**
     * @expectedException \InvalidArgumentException
     *
     * @dataProvider exceptionProvider
     */
    public function testMacAddrThrowExceptionOnConversion($value)
    {
        $this->_type->convertToDatabaseValue($value, $this->_platform);
    }

    /**
     * Provider for conversion test values.
     *
     * @return array
     */
    public static function databaseConvertProvider()
    {
        return array(
            array('08:00:2b:01:02:03', '08:00:2b:01:02:03'),
            array('08-00-2b-01-02-03', '08-00-2b-01-02-03'),
            array('08002b:010203', '08002b:010203'),
            array('08002b-010203', '08002b-010203'),
            array('0800.2b01.0203', '0800.2b01.0203'),
            array('08002b010203', '08002b010203'),
        );
    }

    /**
     * @return array
     */
    public static function exceptionProvider()
    {
        return array(
            array(''),
            array('someothervalue'),
            array(123),
            array('123345'),
            array('08-00-2b:01-02-03'),
            array('08-00-2b:01-02-03-00')
        );
    }
}
