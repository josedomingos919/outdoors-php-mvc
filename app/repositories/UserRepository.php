<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\User;

class UserRepository extends PDOAdapter implements IUserRepository
{
    public function getUser(int $user_id)
    {
        try {
            $response = $this->query("SELECT *FROM user WHERE id=$user_id");

            $rows = @$response->fetchAll(\PDO::FETCH_ASSOC)[0];

            return isset($rows) ? new User($rows['id'], $rows['email'], $rows['password'], $rows['username'], $rows['status'], $rows['access']) : NULL;
        } catch (\Exception $error) {
            return NULL;
        }
    }

    public function addUser(User $user)
    {
        try {
            $this->query("INSERT INTO user VALUES('$user->id','$user->username', '$user->password', '$user->email', '$user->status', '$user->access')");

            return $this->getUser($this->lastInsertId());
        } catch (\Exception $error) {
            return NULL;
        }
    }
}
