<?php

namespace App\Repositories;

interface IProvinceRepository {
    public function getOne(int $id);
    public function getAll() : array;
}