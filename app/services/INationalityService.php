<?php

namespace App\Services;

interface INationalityService
{
    public function getOne(int $id);
    public function getAll(): array;
}
