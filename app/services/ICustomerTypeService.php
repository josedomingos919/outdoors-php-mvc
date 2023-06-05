<?php

namespace App\Services;

use App\Model\CustomerType;

interface ICustomerTypeService
{
    public function getOne(int $id): CustomerType;
    public function getAll(): array;
}
