<?php

namespace App\Model;

use App\Core\Model;

class Nationality extends Model
{
    public $id;
    public $name;

    public function __construct($id,  $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
