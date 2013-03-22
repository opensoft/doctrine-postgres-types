<?php

namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

class TextArrayTypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\TsvectorType
     */
    protected $_type;

    protected $_platform;

    public static function setUpBeforeClass()
    {
        Type::addType('text_array', "Doctrine\\DBAL\\PostgresTypes\\TextArrayType");
    }

    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('text_array');
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testTextArrayConvertsToDatabaseValue($serialized, $array)
    {
        $converted = $this->_type->convertToDatabaseValue($array, $this->_platform);
        $this->assertInternalType('string', $converted);
        $this->assertEquals($serialized, $converted);
    }

    /**
     * @dataProvider databaseConvertProvider
     */
    public function testTsvectorConvertsToPHPValue($serialized, $array)
    {
        $converted = $this->_type->convertToPHPValue($serialized, $this->_platform);
        $this->assertInternalType('array', $converted);
        $this->assertEquals($array, $converted);
    }

    public static function databaseConvertProvider()
    {
        return array(
            array('{simple,extended}', array('simple', 'extended'))
        );
    }
}
