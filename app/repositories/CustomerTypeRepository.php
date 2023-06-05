<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\CustomerType;

class CustomerTypeRepository extends PDOAdapter implements ICustomerTypeRepository
{
    public function getOne(int $id)
    {
        $response = $this->query("SELECT *FROM customer_type WHERE id=$id");

        $row = @$response->fetch(\PDO::FETCH_ASSOC)[0];

        return isset($row) ? new CustomerType($row['id'], $row['name'], $row['municipality_id']) : null;
    }

    public function getAll(): array
    {
        $custumerTypes = [];
        $response  = $this->query("SELECT *FROM customer_type ");

        while ($row = $response->fetch(\PDO::FETCH_ASSOC)) {
            $custumerTypes[] = new CustomerType(
                $row['id'],
                $row['type']
            );
        }

        return $custumerTypes;
    }
}
