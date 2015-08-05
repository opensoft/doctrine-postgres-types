<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\DBAL\PostgresTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * TextArrayType.
 *
 * Only supports single dimensional arrays like text[].
 *
 * @author Richard Fullmer <richard.fullmer@opensoftdev.com>
 */
class TextArrayType extends AbstractArrayType
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'text_array';
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'TEXT[]';
    }
}
