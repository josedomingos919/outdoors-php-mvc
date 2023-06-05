<?php

namespace App\Controller;

use App\Core\Registry;

class ErrorController extends Registry {
    public function notFound(){
        echo "Não encontrado";
    }
}