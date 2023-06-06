<?php

namespace App\Services;

use App\Model\Nationality;
use App\Repositories\INationalityRepository;

class NationalityService implements INationalityService
{
    private $nationalistyReposity;

    public function __construct(INationalityRepository $nationalistyReposity)
    {
        $this->nationalistyReposity = $nationalistyReposity;
    }

    public function getOne(int $id): Nationality
    {
        return $this->nationalistyReposity->getOne($id);
    }

    public function getAll(): array
    {
        return $this->nationalistyReposity->getAll();
    }
}
