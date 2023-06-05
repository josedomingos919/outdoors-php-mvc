<?php

namespace App\Model;

use App\Core\Model;

class Customer extends Model
{
    public $id;
    public $typeId;
    public $name;
    public $userId;
    public $activity;
    public $address;
    public $communeId;
    public $nationalityId;
    public $phone;

    public function __construct($id, $typeId, $name, $userId, $activity, $address, $communeId, $nationalityId, $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->typeId = $typeId;
        $this->userId = $userId;
        $this->address = $address;
        $this->activity = $activity;
        $this->communeId = $communeId;
        $this->nationalityId = $nationalityId;
    }
}
