<?php

namespace App\Services;

use App\Model\Commune;
use App\Repositories\CommuneReposity;

class CommuneService implements ICommuneService
{
    private $communeRepository;

    public function __construct(CommuneReposity $communeRepository)
    {
        $this->communeRepository = $communeRepository;
    }

    public function getOne(int $id): Commune
    {
        return $this->communeRepository->getOne($id);
    }

    public function getAll(int $municipality_id): array
    {
        return $this->communeRepository->getAll($municipality_id);
    }
}
