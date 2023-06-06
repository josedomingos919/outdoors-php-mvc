<?php

namespace App\Services;

interface ICommuneService
{
    public function getOne(int $id);
    public function getAll(int $municipality_id): array;
}
