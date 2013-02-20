<?php
/**
 * This file is part of ONP.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 *
 * The unauthorized use of this code outside the boundaries of
 * Opensoft is prohibited.
 */

namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

/**
 * Doctrine\Tests\DBAL\Types\TsqueryTest
 *
 * @author Ivan Molchanov <ivan.molchanov@opensoftdev.ru>
 */
class TsqueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\TsqueryType
     */
    protected $type;

    protected $platform;

    public static function setUpBeforeClass()
    {
        Type::addType('tsquery', "Doctrine\\DBAL\\PostgresTypes\\TsqueryType");
    }

    protected function setUp()
    {
        $this->platform = new PostgreSqlPlatform();
        $this->type = Type::getType('tsquery');
    }

    public function testConvertToDatabaseValueSQL()
    {
        $this->assertEquals('to_tsquery(test)', $this->type->convertToDatabaseValueSQL('test', $this->platform));
    }
}
