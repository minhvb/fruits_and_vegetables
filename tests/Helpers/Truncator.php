<?php

namespace App\Tests\Helpers;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class Truncator
{
    private readonly Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @throws Exception
     */
    public function truncateTable(string $tableName): void
    {
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        $this->connection->executeQuery(sprintf('TRUNCATE TABLE %s;', $tableName));
        $this->connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }
}

