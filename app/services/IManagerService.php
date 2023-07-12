<?php

namespace App\Services;

use App\Model\Manager;
use App\Model\User;

interface IManagerService
{
    public function fillRegisterForm(&$data);
    public function execAddRegitry(User $user, Manager $customer, &$data);
    public function getAll(int $page);
    public function totalPage(): array;
}
