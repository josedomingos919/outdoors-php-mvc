<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\ProvinceService;

class ProvinceController extends Registry
{
    private $provinceService;

    public function __construct(ProvinceService $provinceService)
    {
        parent::__construct();
        $this->provinceService = $provinceService;
    }

    public function all()
    {
        echo json_encode($this->provinceService->getAll());
    }
}
