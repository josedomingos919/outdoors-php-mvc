<?php

namespace App\Services;

use App\Model\Municipality;

interface IMunicipalityService
{
    public function getOne(int $id): Municipality;
    public function getAll(int $province_id): array;
}
