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
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 * @author Eugene Leonovich <gen.work@gmail.com>
 */
class TextArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\TextArrayType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    public static function setUpBeforeClass()
    {
        Type::addType('text_array', 'Doctrine\\DBAL\\PostgresTypes\\TextArrayType');
    }

    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('text_array');
    }

    /**
     * @dataProvider provideValidValues
     */
    public function testTextArrayConvertsToDatabaseValue($serialized, $array)
    {
        $this->assertSame($serialized, $this->_type->convertToDatabaseValue($array, $this->_platform));
    }

    /**
     * @dataProvider provideToPHPValidValues
     */
    public function testTextArrayConvertsToPHPValue($serialized, $array)
    {
        $this->assertSame($array, $this->_type->convertToPHPValue($serialized, $this->_platform));
    }

    public static function provideValidValues()
    {
        return array(
            array('{}', array()),
            array('{""}', array('')),
            array('{NULL}', array(null)),
            array('{"1,NULL"}', array("1,NULL")),
            array('{"NULL,2"}', array("NULL,2")),
            array('{"1",NULL}', array('1', null)),
            array('{"NULL"}', array('NULL')),
            array('{"1,NULL"}', array("1,NULL")),
            array('{"NULL,2"}', array("NULL,2")),
            array('{"1",NULL}', array('1', null)),
            array('{"1","2"}', array('1', '2')),
            array('{"1\"2"}', array('1"2')),
            array('{"\"2"}', array('"2')),
            array('{"\"\""}', array('""')),
        );
    }

    public static function provideToPHPValidValues()
    {
        return self::provideValidValues() + array(
            array('{NULL,2}', array(null, '2')),
            array('{NOTNULL}', array('NOTNULL')),
            array('{NOTNULL,2}', array('NOTNULL', '2')),
            array('{NULL2}', array('NULL2')),
            array('{1,2}', array('1', '2')),
            array('{"1", "2"}', array('1', '2')),
            array('{"1,2", "3,4"}', array('1,2', '3,4')),
        );
    }
}
