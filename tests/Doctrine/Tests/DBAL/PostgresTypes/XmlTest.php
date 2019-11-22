<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\PostgresTypes\XmlType;
use SimpleXMLElement;

final class XmlTest extends TestCase
{
    /**
     * @var XmlType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    public static function setUpBeforeClass() : void
    {
        Type::addType('xml', XmlType::class);
    }

    protected function setUp() : void
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('xml');
    }

    public function testXmlConvertsToDatabaseValue() : void
    {
        $this->assertInternalType('string', $this->_type->convertToDatabaseValue(new SimpleXMLElement('<book></book>'), $this->_platform));
    }

    public function testXmlConvertsToPHPValue() : void
    {
        $this->assertInstanceOf(SimpleXMLElement::class, $this->_type->convertToPHPValue('<book></book>', $this->_platform));
    }
}
