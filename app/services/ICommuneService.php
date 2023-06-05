<?php

namespace App\Services;

use App\Model\Commune;

interface ICommuneService
{
    public function getOne(int $id): Commune;
    public function getAll(int $municipality_id): array;
}
