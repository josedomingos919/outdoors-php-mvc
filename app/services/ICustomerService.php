<?php

namespace App\Services;

use App\Model\Customer;
use App\Model\User;

interface ICustomerService
{
    public function fillRegisterForm(&$data);
    public function execAddRegitry(User $user, Customer $customer, &$data);
}
