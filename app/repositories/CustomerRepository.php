<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\Customer;

class CustomerRepository extends PDOAdapter implements ICustomerRepository
{
    public function getCustomer(int $customer_id): Customer
    {
        try {
            $response = $this->query("SELECT *FROM customer WHERE id=$customer_id");

            $rows = @$response->fetchAll(\PDO::FETCH_ASSOC)[0];

            return isset($rows) ? new Customer(
                $rows['id'],
                $rows['customer_type_id'],
                $rows['name'],
                $rows['user_id'],
                $rows['activity'],
                $rows['address'],
                $rows['commune_id'],
                $rows['nationality_id'],
                $rows['phone'],
            ) : NULL;
        } catch (\Exception $error) {
            return NULL;
        }
    }

    public function addCustomer(Customer $customer)
    {
        try {
            $this->query("
                INSERT INTO customer 
                VALUES(
                    '$customer->id', 
                    '$customer->name', 
                    '$customer->phone', 
                    '$customer->nationalityId', 
                    '$customer->typeId', 
                    '$customer->communeId', 
                    '$customer->userId', 
                    '$customer->address', 
                    '$customer->activity'
                );
            ");

            return $this->getCustomer($this->lastInsertId());
        } catch (\Exception $error) {
            return NULL;
        }
    }
}
