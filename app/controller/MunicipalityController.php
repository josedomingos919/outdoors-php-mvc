<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\IMunicipalityService;

class MunicipalityController extends Registry
{

    private $municipalityService;

    public function __construct(IMunicipalityService $municipalityService)
    {
        parent::__construct();
        $this->municipalityService = $municipalityService;
    }

    public function all()
    {
        $province_id = @$this->request->get['province_id'];

        echo json_encode(
            isset($province_id)
                ? $this->municipalityService->getAll($province_id)
                : []
        );
    }
}
