<?php

namespace App\Services;

use App\Model\Municipality;
use App\Repositories\IMunicipalityReposity;

class MunicipalityService implements IMunicipalityService
{
    private $municipalityRespository;

    public function __construct(IMunicipalityReposity $municipalityRespository)
    {
        $this->municipalityRespository = $municipalityRespository;
    }

    public function getOne(int $id): Municipality
    {
        return $this->municipalityRespository->getOne($id);
    }

    public function getAll(int $province_id): array
    {
        return $this->municipalityRespository->getAll($province_id);
    }
}
