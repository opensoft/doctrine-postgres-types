<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\DBAL\PostgresTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * @author Evgeny Kukharik <jonegkk9@gmail.com>
 */
class MacAddrType extends Type
{
    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'macaddr';
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return;
        }
        // match 00:00:00:00:00:00
        if (preg_match('/^((([0-9A-Fa-f]{2}):){5})([0-9A-Fa-f]{2})$/', $value)) {
            return $value;
        }
        // match 00-00-00-00-00-00
        if (preg_match('/^((([0-9A-Fa-f]{2})-){5})([0-9A-Fa-f]{2})$/', $value)) {
            return $value;
        }
        // match 000000:000000 or 000000-000000
        if (preg_match('/^([0-9A-Fa-f]{6})(:|-)([0-9A-Fa-f]{6})$/', $value)) {
            return $value;
        }
        // match 0000.0000.0000
        if (preg_match('/^([0-9A-Fa-f]{4}).([0-9A-Fa-f]{4}).([0-9A-Fa-f]{4})$/', $value)) {
            return $value;
        }
        // match 000000000000
        if (preg_match('/^([0-9A-Fa-f]{12})$/', $value)) {
            return $value;
        }
        throw new \InvalidArgumentException(sprintf('%s is not a properly formatted MACADDR type.', $value));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'macaddr';
    }
}
