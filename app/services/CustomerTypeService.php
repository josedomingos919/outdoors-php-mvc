<?php

namespace App\Services;

use App\Model\CustomerType;
use App\Repositories\CustomerTypeRepository;

class CustomerTypeService implements ICustomerTypeService
{
    private $customerTypeRepository;

    public function __construct(CustomerTypeRepository $customerTypeRepository)
    {
        $this->customerTypeRepository = $customerTypeRepository;
    }

    public function getOne(int $id): CustomerType
    {
        return $this->customerTypeRepository->getOne($id);
    }

    public function getAll(): array
    {
        return $this->customerTypeRepository->getAll();
    }
}
