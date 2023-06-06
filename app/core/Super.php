<?php

namespace App\Core;

class Super extends Registry
{
    public function nav()
    {
        return $this->getHtml('site/nav');
    }

    public function user()
    {
        return isset($this->request->session["user"]) ? $this->request->session["user"] : null;
    }
}
