<?php

namespace App\Services;

use App\Model\Province;
use App\Repositories\ProvinceRepository;

class ProvinceService implements IProvinceService
{
    private $provinceRespository;

    public function __construct(ProvinceRepository $provinceRespository)
    {
        $this->provinceRespository = $provinceRespository;
    }

    public function getOne(int $id): Province
    {
        return $this->provinceRespository->getOne($id);
    }

    public function getAll(): array
    {
        return $this->provinceRespository->getAll();
    }
}
