<?php

/**
 * This file is part of Opensoft Doctrine Postgres Types.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 */
namespace Doctrine\DBAL\PostgresTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

/**
 * Only supports single dimensional arrays like text[].
 *
 * @author Eugene Leonovich <gen.work@gmail.com>
 */
class TextArrayType extends Type
{
    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (empty($value)) {
            return '{}';
        }

        $result = '';
        foreach ($value as $part) {
            if (null === $part) {
                $result .= 'NULL,';
                continue;
            }
            if ('' === $part) {
                $result .= '"",';
                continue;
            }

            $result .= '"'.addcslashes($part, '"').'",';
        }

        return '{'.substr($result, 0, -1).'}';
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (empty($value) || '{}' === $value) {
            return array();
        }

        // @see http://stackoverflow.com/a/19082849/1160901
        preg_match_all('/(?<=^\{|,)(([^,"{]*)|\s*"((?:[^"\\\\]|\\\\(?:.|[0-9]+|x[0-9a-f]+))*)"\s*)(,|(?<!^\{)(?=\}$))/i', $value, $matches, PREG_SET_ORDER);

        $array = array();
        foreach ($matches as $match) {
            if ('' !== $match[3]) {
                $array[] = stripcslashes($match[3]);
                continue;
            }

            $array[] = 'NULL' === $match[2] ? null : $match[2];
        }

        return $array;
    }

    /**
     * {@inheritdoc}
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
