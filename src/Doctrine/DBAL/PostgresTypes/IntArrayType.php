<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\DBAL\PostgresTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * IntArrayType.
 *
 * Only supports single dimensional arrays like text[].
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class IntArrayType extends AbstractArrayType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'int_array';
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return '_int4';
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $result = parent::convertToPHPValue($value, $platform);

        return array_map('intval', $result);
    }
}
