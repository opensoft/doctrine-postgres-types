Provides Common Postgres Types for Doctrine
-------------------------------------------

[![Build Status](https://secure.travis-ci.org/opensoft/doctrine-postgres-types.png?branch=master)](http://travis-ci.org/opensoft/doctrine-postgres-types)

Provides Doctrine Type classes for common postgres types

#### Using with Symfony2 Doctrine Configuration

    # Doctrine Configuration
    doctrine:
        dbal:
            types:
                text_array: "Doctrine\\DBAL\\PostgresTypes\\TextArrayType"
                tsvector: "Doctrine\\DBAL\\PostgresTypes\\TsvectorType"
                tsquery: "Doctrine\\DBAL\\PostgresTypes\\TsqueryType"
                xml: "Doctrine\\DBAL\\PostgresTypes\\XmlType"
                inet: "Doctrine\\DBAL\\PostgresTypes\\InetType"

#### Using with Doctrine

    <?php

    use Doctrine\DBAL\Types\Type;

    Type::addType('text_array', "Doctrine\\DBAL\\PostgresTypes\\TextArrayType");
    Type::addType('tsvector', "Doctrine\\DBAL\\PostgresTypes\\TsvectorType");
    Type::addType('tsquery', "Doctrine\\DBAL\\PostgresTypes\\TsqueryType");
    Type::addType('xml', "Doctrine\\DBAL\\PostgresTypes\\XmlType");
    Type::addType('inet', "Doctrine\\DBAL\\PostgresTypes\\InetType");

#### License

Licensed under the MIT License
