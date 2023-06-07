<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\CustomerTypeService;

class CustomerTypeController extends Registry
{
    private $customerTypeService;

    public function __construct(CustomerTypeService $customerTypeService)
    {
        parent::__construct();
        $this->customerTypeService = $customerTypeService;
    }

    public function all()
    {
        echo json_encode($this->customerTypeService->getAll());
    }
}
