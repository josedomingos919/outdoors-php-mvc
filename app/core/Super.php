<?php

namespace App\Core;

class Super extends Registry
{
    public function nav()
    {
        return $this->getHtml('site/nav');
    }
}
