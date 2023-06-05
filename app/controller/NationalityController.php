<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\NationalityService;

class NationalityController extends Registry
{
    private $nationalityService;

    public function __construct(NationalityService  $nationalityService)
    {
        parent::__construct();
        $this->nationalityService = $nationalityService;
    }

    public function all()
    {
        echo json_encode($this->nationalityService->getAll());
    }
}