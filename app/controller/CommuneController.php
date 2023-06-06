<?php

namespace App\Controller;

use App\Core\Registry;
use App\Services\ICommuneService;

class CommuneController extends Registry
{
    private $communeService;

    public function __construct(ICommuneService $communeService)
    {
        parent::__construct();
        $this->communeService = $communeService;
    }

    public function all()
    {
        $municipality_id = @$this->request->get['municipality_id'];

        echo json_encode(isset($municipality_id) ? $this->communeService->getAll($municipality_id) : []);
    }
}
