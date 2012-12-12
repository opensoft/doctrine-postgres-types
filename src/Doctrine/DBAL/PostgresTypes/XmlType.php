<?php

namespace Doctrine\DBAL\PostgresTypes;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * PHP Type = SimpleXMLElement
 * Postgres Type = XML
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class XmlType extends Type
{
    public function getName()
    {
        return 'xml';
    }

    public function canRequireSQLConversion()
    {
        return true;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "XML";
    }

    /**
     * Converts a value from its database representation to its PHP representation
     * of this type.
     *
     * @param mixed $value The value to convert.
     * @param AbstractPlatform $platform The currently used database platform.
     * @return mixed The PHP representation of the value.
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new \SimpleXMLElement($value);
    }

    /**
     * Modifies the SQL expression (identifier, parameter) to convert to a PHP value.
     *
     * @param string $sqlExpr
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToPHPValueSQL($value, $platform)
    {
        return $value;
    }

    /**
     * Modifies the SQL expression (identifier, parameter) to convert to a database value.
     *
     * @param string $sqlExpr
     * @param AbstractPlatform $platform
     * @return string
     */
    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return $sqlExpr;
    }

    /**
     * Converts a value from its PHP representation to its database representation
     * of this type.
     *
     * @param mixed $value The value to convert.
     * @param AbstractPlatform $platform The currently used database platform.
     * @return mixed The database representation of the value.
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value instanceof \SimpleXMLElement) {
            $value = $value->asXML();
        }

        return $value;
    }
}
