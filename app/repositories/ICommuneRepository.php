<?php

namespace App\Repositories;

interface ICommuneRepository
{
    public function getOne(int $id);
    public function getAll(int $municipality_id): array;
}
