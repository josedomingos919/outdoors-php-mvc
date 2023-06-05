<?php

namespace App\Repositories;

use App\Model\Nationality;

interface INationalityRepository
{
    public function getOne(int $id): Nationality;
    public function getAll(): array;
}
