<?php

namespace App\Services;

use App\Repositories\CommuneReposity;

class CommuneService implements ICommuneService
{
    private $communeRepository;

    public function __construct(CommuneReposity $communeRepository)
    {
        $this->communeRepository = $communeRepository;
    }

    public function getOne(int $id)
    {
        return $this->communeRepository->getOne($id);
    }

    public function getAll(int $municipality_id): array
    {
        return $this->communeRepository->getAll($municipality_id);
    }
}
