<?php

namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

class TsvectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\TsvectorType
     */
    protected $_type;

    protected $_platform;

    public static function setUpBeforeClass()
    {
        Type::addType('tsvector', "Doctrine\\DBAL\\PostgresTypes\\TsvectorType");
    }

    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('tsvector');
    }

    public function testTsvectorConvertsToDatabaseValue()
    {
        $this->assertInternalType('string', $this->_type->convertToDatabaseValue(array('simple', 'extended'), $this->_platform));
    }

    public function testTsvectorConvertsToPHPValue()
    {
        $this->assertInternalType('array', $this->_type->convertToPHPValue('ts:simple ts:extended', $this->_platform));
    }
}
