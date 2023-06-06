<?php

namespace App\Repositories;

use App\Model\Manager;

interface IManagerRepository
{
    public function addManager(Manager $customer);
    public function getManager(int $customer_id);
    public function getManagerByUserId(int $customer_id);
}
