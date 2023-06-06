<?php

namespace App\Services;

use App\Model\Customer;
use App\Model\User;

interface ICustomerService
{
    public function execUpdateRegitry(User $user, Customer $customer, &$data);
    public function fillRegisterForm(&$data);
    public function execAddRegitry(User $user, Customer $customer, &$data);
    public function notifyAdmin();
    public function fillSelectData(&$data);
    public function validateFormData(User $user, Customer $customer, &$data): bool;
    public function getCustomerByUserId(int $user_id);
}
