<?php

namespace App\Model;

use App\Core\Model;

class Commune extends Model
{
    public $id;
    public $name;
    public $municipality_id;

    public function __construct($id, $name, $municipality_id)
    {
        $this->id = $id;
        $this->name = $name;
        $this->municipality_id = $municipality_id;
    }
}