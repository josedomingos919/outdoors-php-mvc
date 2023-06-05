<?php

namespace App\Model;

use App\Core\Model;

class Municipality extends Model
{
    public $id;
    public $name;
    public $province_id;

    public function __construct($id, $name, $province_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->province_id = $province_id;
    }
}