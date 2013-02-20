Provides Common Postgres Types for Doctrine
-------------------------------------------

[![Build Status](https://secure.travis-ci.org/opensoft/doctrine-postgres-types.png?branch=master)](http://travis-ci.org/opensoft/doctrine-postgres-types)

Provides Doctrine Type classes for common postgres types

#### Using with Symfony2 Doctrine Configuration

    # Doctrine Configuration
    doctrine:
        dbal:
            types:
                tsvector: "Doctrine\\DBAL\\PostgresTypes\\TsvectorType"
                xml: "Doctrine\\DBAL\\PostgresTypes\\XmlType"
                tsquery: "Doctrine\\DBAL\\PostgresTypes\\TsqueryType"

#### Using with Doctrine

    <?php

    use Doctrine\DBAL\Types\Type;

    Type::addType('tsvector', "Doctrine\\DBAL\\PostgresTypes\\TsvectorType");
    Type::addType('xml', "Doctrine\\DBAL\\PostgresTypes\\XmlType");
    Type::addType('tsquery', "Doctrine\\DBAL\\PostgresTypes\\TsqueryType");

#### License

Licensed under the MIT License
