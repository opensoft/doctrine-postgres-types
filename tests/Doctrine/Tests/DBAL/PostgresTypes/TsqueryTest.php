<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\PostgresTypes\TsqueryType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;
use PHPUnit\Framework\TestCase;

final class TsqueryTest extends TestCase
{
    /**
     * @var TsqueryType
     */
    protected $type;

    /**
     * @var PostgreSqlPlatform
     */
    protected $platform;

    public static function setUpBeforeClass() : void
    {
        Type::addType('tsquery', TsqueryType::class);
    }

    protected function setUp() : void
    {
        $this->platform = new PostgreSqlPlatform();
        $this->type = Type::getType('tsquery');
    }

    public function testConvertToDatabaseValueSQL() : void
    {
        $this->assertEquals('plainto_tsquery(test)', $this->type->convertToDatabaseValueSQL('test', $this->platform));
    }
}
