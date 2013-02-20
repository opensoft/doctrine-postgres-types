<?php
/**
 * This file is part of ONP.
 *
 * Copyright (c) 2013 Opensoft (http://opensoftdev.com)
 *
 * The unauthorized use of this code outside the boundaries of
 * Opensoft is prohibited.
 */

namespace Doctrine\DBAL\PostgresTypes;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Opensoft\Onp\WebBundle\Doctrine\DBAL\Types\TsqueryType
 *
 * @author Ivan Molchanov <ivan.molchanov@opensoftdev.ru>
 */
class TsqueryType extends Type
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'tsquery';
    }

    /**
     * {@inheritdoc}
     */
    public function canRequireSQLConversion()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "TSQUERY";
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValueSQL($sqlExpr, AbstractPlatform $platform)
    {
        return sprintf('to_tsquery(%s)', $sqlExpr);
    }

}
