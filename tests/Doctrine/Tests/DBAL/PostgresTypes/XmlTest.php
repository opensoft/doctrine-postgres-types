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
 * Class XmlTest.
 *
 * Unit tests for the XML type
 */
class XmlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\XmlType
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
        Type::addType('xml', 'Doctrine\\DBAL\\PostgresTypes\\XmlType');
    }

    /**
     * Pre-execution setup.
     */
    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('xml');
    }

    /**
     * Test conversion of SimpleXMLElement to database value.
     */
    public function testXmlConvertsToDatabaseValue()
    {
        $this->assertInternalType('string', $this->_type->convertToDatabaseValue(new \SimpleXMLElement('<book></book>'), $this->_platform));
    }

    /**
     * Test conversion of database value to SimpleXMLElement.
     */
    public function testXmlConvertsToPHPValue()
    {
        $this->assertInstanceOf('\SimpleXMLElement', $this->_type->convertToPHPValue('<book></book>', $this->_platform));
    }
}
