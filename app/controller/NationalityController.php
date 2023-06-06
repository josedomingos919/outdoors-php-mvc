<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\INationalityService;

class NationalityController extends Registry
{
    private $nationalityService;

    public function __construct(INationalityService  $nationalityService)
    {
        parent::__construct();
        $this->nationalityService = $nationalityService;
    }

    public function all()
    {
        echo json_encode($this->nationalityService->getAll());
    }
}
