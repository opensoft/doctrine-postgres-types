<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\PostgresTypes\InetType;

final class InetTypeTest extends TestCase
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
        Type::addType('inet', InetType::class);
    }

    protected function setUp() : void
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('inet');
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testInetConvertsToDatabaseValue($serialized, $phpValueToConvert) : void
    {
        $converted = $this->_type->convertToDatabaseValue($phpValueToConvert, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($serialized, $converted);
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testInetConvertsToPHPValue($serialized, $databaseValueToConvert) : void
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($databaseValueToConvert, $converted);
    }

    /**
     * @dataProvider exceptionProvider
     */
    public function testInetThrowExceptionOnConversion($value) : void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->_type->convertToDatabaseValue($value, $this->_platform);
    }

    public static function databaseConvertProvider() : array
    {
        return [
            ['10.0.0.1', '10.0.0.1'],
            ['10.0.0.1/4', '10.0.0.1/4'],
        ];
    }

    public static function exceptionProvider() : array
    {
        return [
            [''],
            ['someothervalue'],
            [123],
            ['123345'],
        ];
    }
}
