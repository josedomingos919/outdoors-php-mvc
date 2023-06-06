<?php

namespace App\Model;

use App\Core\Model;

class Manager extends Model
{
    public $id;
    public $name;
    public $userId;
    public $address;
    public $communeId;
    public $phone;

    public function __construct($id, $name, $userId, $address, $communeId,  $phone)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->userId = $userId;
        $this->address = $address;
        $this->communeId = $communeId;
    }
}
