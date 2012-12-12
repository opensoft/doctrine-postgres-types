<?php

namespace Doctrine\Tests\DBAL\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\PostgreSqlPlatform;

class XmlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Doctrine\DBAL\PostgresTypes\XmlType
     */
    protected $_type;

    protected $_platform;

    public static function setUpBeforeClass()
    {
        Type::addType('xml', "Doctrine\\DBAL\\PostgresTypes\\XmlType");
    }

    protected function setUp()
    {
        $this->_platform = new PostgreSqlPlatform();
        $this->_type = Type::getType('xml');
    }

    public function testTsvectorConvertsToDatabaseValue()
    {
        $this->assertInternalType('string', $this->_type->convertToDatabaseValue(new \SimpleXMLElement('<book></book>'), $this->_platform));
    }

    public function testTsvectorConvertsToPHPValue()
    {
        $this->assertInstanceOf('\SimpleXMLElement', $this->_type->convertToPHPValue('<book></book>', $this->_platform));
    }
}
