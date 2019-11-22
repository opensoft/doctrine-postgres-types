<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\PostgresTypes\TsvectorType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use PHPUnit\Framework\TestCase;

final class TsvectorTest extends TestCase
{
    /**
     * @var TsvectorType
     */
    protected $_type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $_platform;

    public static function setUpBeforeClass() : void
    {
        Type::addType('tsvector', TsvectorType::class);
    }

    protected function setUp() : void
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('tsvector');
    }

    public function testTsvectorConvertsToDatabaseValue() : void
    {
        $this->assertInternalType('string', $this->_type->convertToDatabaseValue(array('simple', 'extended'), $this->_platform));
    }

    public function testTsvectorConvertsToPHPValue() : void
    {
        $this->assertInternalType('array', $this->_type->convertToPHPValue('ts:simple ts:extended', $this->_platform));
    }
}
