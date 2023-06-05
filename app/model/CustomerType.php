<?php

namespace App\Model;

use App\Core\Model;

class CustomerType extends Model
{
    public $id;
    public $type;

    public function __construct($id, $type)
    {
        $this->id = $id;
        $this->type = $type;
    }
}
