<?php

namespace App\Model;

use App\Core\Model;

class User extends Model
{
    const STATUS_ACTIVE   = '1';
    const STATUS_INACTIVE = '0';

    const ACCESS_NORMAL  = 'normal';
    const ACCESS_ADMIN   = 'admin';
    const ACCESS_MANAGER = 'manager';

    public $id;
    public $email;
    public $status;
    public $access;
    public $password;
    public $username;

    public function __construct($id = NULL,  $email, $password, $username, $status = '0', $access = 'normal')
    {
        $this->id = $id;
        $this->email = $email;
        $this->access = $access;
        $this->status = $status;
        $this->password = $password;
        $this->username = $username;
    }
}
