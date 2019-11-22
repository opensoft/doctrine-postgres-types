<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\PostgresTypes\IntArrayType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use PHPUnit\Framework\TestCase;

final class IntArrayTypeTest extends TestCase
{
    /**
     * @var IntArrayType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    public static function setUpBeforeClass() : void
    {
        Type::addType('int_array', IntArrayType::class);
    }

    protected function setUp() : void
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('int_array');
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testIntArrayConvertsToDatabaseValue($serialized, $array) : void
    {
        $converted = $this->_type->convertToDatabaseValue($array, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($serialized, $converted);
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testIntArrayConvertsToPHPValue($serialized, $array) : void
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('array', $converted);
        $this->assertEquals($array, $converted);

        if (sizeof($converted) > 0) {
            $this->assertInternalType('int', reset($converted));
        }
    }

    public static function databaseConvertProvider() : array
    {
        return [
            ['{1,2,3}', [1, 2, 3]],
            ['{}', []],
        ];
    }
}
