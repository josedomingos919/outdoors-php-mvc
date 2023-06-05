<?php

namespace App\Repositories;

use App\Model\Customer;

interface ICustomerRepository
{
    public function addCustomer(Customer $customer);
    public function getCustomer(int $customer_id): Customer;
}
