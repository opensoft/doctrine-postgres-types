<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\PostgresTypes\TextArrayType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use PHPUnit\Framework\TestCase;

final class TextArrayTypeTest extends TestCase
{
    /**
     * @var TextArrayType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    public static function setUpBeforeClass() : void
    {
        Type::addType('text_array', TextArrayType::class);
    }

    protected function setUp() : void
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('text_array');
    }

    /**
     * @dataProvider provideValidValues
     */
    public function testTextArrayConvertsToDatabaseValue($serialized, $array) : void
    {
        $this->assertSame($serialized, $this->_type->convertToDatabaseValue($array, $this->_platform));
    }

    /**
     * @dataProvider provideToPHPValidValues
     */
    public function testTextArrayConvertsToPHPValue($serialized, $array) : void
    {
        $this->assertSame($array, $this->_type->convertToPHPValue($serialized, $this->_platform));
    }

    public static function provideValidValues() : array
    {
        return [
            ['{}', []],
            ['{""}', ['']],
            ['{NULL}', [null]],
            ['{"1,NULL"}', ['1,NULL']],
            ['{"NULL,2"}', ['NULL,2']],
            ['{"1",NULL}', ['1', null]],
            ['{"NULL"}', ['NULL']],
            ['{"1,NULL"}', ['1,NULL']],
            ['{"1","2"}', ['1', '2']],
            ['{"1\"2"}', ['1"2']],
            ['{"\"2"}', ['"2']],
            ['{"\"\""}', ['""']],
            ['{"1","2"}', ['1', '2']],
            ['{"1,2","3,4"}', ['1,2', '3,4']],
        ];
    }

    public static function provideToPHPValidValues() : array
    {
        return self::provideValidValues() + [
            ['{NULL,2}', [null, '2']],
            ['{NOTNULL}', ['NOTNULL']],
            ['{NOTNULL,2}', ['NOTNULL', '2']],
            ['{NULL2}', ['NULL2']],
            ['{1,2}', ['1', '2']],
        ];
    }
}
