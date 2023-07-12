<?php

namespace App\Services;

use App\Model\Customer;
use App\Model\Outdoor;
use App\Model\User;

interface IOutdoorService
{
    public function execUpdateRegitry(User $user, Customer $customer, &$data);
    public function fillRegisterForm(&$data);
    public function execAddRegitry(Outdoor $outdoor, &$data);
    public function notifyAdmin();
    public function fillSelectData(&$data);
    public function validateFormData(Outdoor $outdoor, &$data): bool;
    public function getCustomerByUserId(int $user_id);
}
