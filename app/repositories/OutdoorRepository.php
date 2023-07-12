<?php

namespace App\Repositories;

use App\Core\Pagination;
use App\DBConfig\PDOAdapter;
use App\Model\Outdoor;
use App\Model\OutdoorType;
use App\Model\User;

class OutdoorRepository extends PDOAdapter implements IOutdoorRepository
{
    public function getAllTypes(): array
    {
        $municipalities = [];
        $response  = $this->query("SELECT *FROM outdoor_type");

        while ($row = $response->fetch(\PDO::FETCH_ASSOC)) {
            $municipalities[] =  new OutdoorType($row['id'], $row['type']);
        }

        return $municipalities;
    }

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


    public function getAll($page)
    {
        try {
            $response = $this->query("SELECT *FROM user LIMIT " . Pagination::getStart($page) . " , " . Pagination::getEnd());
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

    public function totalPage(): array
    {
        try {
            $response = $this->query("SELECT COUNT(*) as total FROM user");

            $total = $response->fetchAll(\PDO::FETCH_ASSOC)[0]['total'];
            $pages = $total / Pagination::getEnd();

            return array('total' => $total, 'pages' => $pages);
        } catch (\Exception $error) {
            return 0;
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

    public function add(Outdoor $outdoor)
    {
        try {
            $this->query("INSERT INTO outdoor VALUES(default, '$outdoor->tipoId','$outdoor->price','$outdoor->status','$outdoor->communeId')");

            return true;
        } catch (\Exception $error) {
            return NULL;
        }
    }
}
