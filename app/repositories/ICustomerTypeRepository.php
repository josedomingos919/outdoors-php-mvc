<?php

namespace App\Repositories;

interface ICustomerTypeRepository
{
    public function getOne(int $id);
    public function getAll(): array;
}
