<?php

namespace App\Services;

use App\Model\Province;
use App\Repositories\IProvinceRepository;

class ProvinceService implements IProvinceService
{
    private $provinceRespository;

    public function __construct(IProvinceRepository $provinceRespository)
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
