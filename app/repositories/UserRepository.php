<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\User;

class UserRepository extends PDOAdapter implements IUserRepository
{

    public function getUserByUsername(string $username)
    {
        try {
            $response = $this->query("SELECT *FROM user WHERE username='$username'");

            $rows = @$response->fetchAll(\PDO::FETCH_ASSOC)[0];

            return isset($rows) ? new User($rows['id'], $rows['email'], $rows['password'], $rows['username'], $rows['status'], $rows['access']) : NULL;
        } catch (\Exception $error) {
            return NULL;
        }
    }

    public function getAdmins()
    {
        try {
            $response = $this->query("SELECT *FROM user WHERE access='" . User::ACCESS_ADMIN . "'");
            $rows = $response->fetchAll(\PDO::FETCH_ASSOC);
            $users = array();

            foreach ($rows as $row) {
                $users[] = new User($row['id'], $row['email'], $row['password'], $row['username'], $row['status'], $row['access']);
            }

            return $users;
        } catch (\Exception $error) {
            return NULL;
        }
    }


    public function getAll()
    {
        try {
            $response = $this->query("SELECT *FROM user");
            $rows = $response->fetchAll(\PDO::FETCH_ASSOC);
            $users = array();

            foreach ($rows as $row) {
                $users[] = new User($row['id'], $row['email'], $row['password'], $row['username'], $row['status'], $row['access']);
            }

            return $users;
        } catch (\Exception $error) {
            return NULL;
        }
    }

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

    public function updateUser(User $user)
    {
        try {
            $this->query("
                UPDATE 
                    user 
                SET 
                    username='$user->username', 
                    password='$user->password', 
                    email='$user->email', 
                    status='$user->status', 
                    access='$user->access'
                WHERE
                    id=$user->id
            ");

            return true;
        } catch (\Exception $error) {
            return false;
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
