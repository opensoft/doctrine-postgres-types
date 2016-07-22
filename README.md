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
                int_array: "Doctrine\\DBAL\\PostgresTypes\\IntArrayType"
                ts_vector: "Doctrine\\DBAL\\PostgresTypes\\TsvectorType"
                ts_query: "Doctrine\\DBAL\\PostgresTypes\\TsqueryType"
                xml: "Doctrine\\DBAL\\PostgresTypes\\XmlType"
                inet: "Doctrine\\DBAL\\PostgresTypes\\InetType"
                macaddr: "Doctrine\\DBAL\\PostgresTypes\\MacAddrType"
            mapping_types:
                _text: text_array
                _int4: int_array
                tsvector: ts_vector
                tsquery: ts_query
                xml: xml
                inet: inet
                macaddr: macaddr

#### Using with Doctrine

    <?php

    use Doctrine\DBAL\Types\Type;

    Type::addType('text_array', "Doctrine\\DBAL\\PostgresTypes\\TextArrayType");
    Type::addType('int_array', "Doctrine\\DBAL\\PostgresTypes\\IntArrayType");
    Type::addType('tsvector', "Doctrine\\DBAL\\PostgresTypes\\TsvectorType");
    Type::addType('tsquery', "Doctrine\\DBAL\\PostgresTypes\\TsqueryType");
    Type::addType('xml', "Doctrine\\DBAL\\PostgresTypes\\XmlType");
    Type::addType('inet', "Doctrine\\DBAL\\PostgresTypes\\InetType");
    Type::addType('macaddr', "Doctrine\\DBAL\\PostgresTypes\\MacAddrType");

#### License

Licensed under the MIT License
