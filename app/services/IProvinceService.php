<?php

namespace App\Services;

interface IProvinceService
{
    public function getOne(int $id);
    public function getAll(): array;
}
