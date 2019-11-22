<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\PostgresTypes\InetType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\PostgresTypes\MacAddrType;

final class MacAddrTypeTest extends TestCase
{
    /**
     * @var InetType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    public static function setUpBeforeClass() : void
    {
        Type::addType('macaaddr', MacAddrType::class);
    }

    protected function setUp() : void
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('macaaddr');
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testMacAddrConvertsToDatabaseValue($serialized, $phpValueToConvert) : void
    {
        $converted = $this->_type->convertToDatabaseValue($phpValueToConvert, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($serialized, $converted);
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testMacAddrConvertsToPHPValue($serialized, $databaseValueToConvert) : void
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($databaseValueToConvert, $converted);
    }

    /**
     * @dataProvider exceptionProvider
     */
    public function testMacAddrThrowExceptionOnConversion($value) : void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->_type->convertToDatabaseValue($value, $this->_platform);
    }

    public static function databaseConvertProvider() : array
    {
        return [
            ['08:00:2b:01:02:03', '08:00:2b:01:02:03'],
            ['08-00-2b-01-02-03', '08-00-2b-01-02-03'],
            ['08002b:010203', '08002b:010203'],
            ['08002b-010203', '08002b-010203'],
            ['0800.2b01.0203', '0800.2b01.0203'],
            ['08002b010203', '08002b010203'],
        ];
    }

    public static function exceptionProvider() : array
    {
        return [
            [''],
            ['someothervalue'],
            [123],
            ['123345'],
            ['08-00-2b:01-02-03'],
            ['08-00-2b:01-02-03-00']
        ];
    }
}
