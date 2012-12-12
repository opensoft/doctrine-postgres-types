Provides Common Postgres Types for Doctrine
-------------------------------------------

Provides Doctrine Type classes for common postgres types

#### Using with Symfony2 Doctrine Configuration

    # Doctrine Configuration
    doctrine:
        dbal:
            types:
                tsvector: "Doctrine\\DBAL\\PostgresTypes\\TsvectorType"
                xml: "Doctrine\\DBAL\\PostgresTypes\\XmlType"

#### Using with Doctrine

    <?php

    use Doctrine\DBAL\Types\Type;

    Type::addType('tsvector', "Doctrine\\DBAL\\PostgresTypes\\TsvectorType");
    Type::addType('xml', "Doctrine\\DBAL\\PostgresTypes\\XmlType");

#### License

Licensed under the MIT License
