<?php

namespace App\Controller;

use App\Core\Registry;

class ErrorController extends Registry
{
    public function notFound()
    {
        $this->getView('error/not_found');
    }
}
