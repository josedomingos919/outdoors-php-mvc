<?php

namespace App\Repositories;

interface IMunicipalityReposity
{
    public function getOne(int $id);
    public function getAll(int $province_id): array;
}