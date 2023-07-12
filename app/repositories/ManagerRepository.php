<?php

namespace App\Repositories;

use App\Core\Pagination;
use App\DBConfig\PDOAdapter;
use App\Model\Manager;
use App\Model\User;

class ManagerRepository extends PDOAdapter implements IManagerRepository
{
    public function getManager(int $manager_id)
    {
        try {
            $response = $this->query("SELECT *FROM manager WHERE id=$manager_id");

            $rows = @$response->fetchAll(\PDO::FETCH_ASSOC)[0];

            return isset($rows) ? new Manager(
                $rows['id'],
                $rows['name'],
                $rows['user_id'],
                $rows['address'],
                $rows['commune_id'],
                $rows['phone'],
            ) : NULL;
        } catch (\Exception $error) {
            return NULL;
        }
    }

    public function getManagerByUserId(int $user_id)
    {
        try {
            $response = $this->query("SELECT *FROM manager WHERE user_id=$user_id");

            $rows = @$response->fetchAll(\PDO::FETCH_ASSOC)[0];

            return isset($rows) ? new Manager(
                $rows['id'],
                $rows['name'],
                $rows['user_id'],
                $rows['address'],
                $rows['commune_id'],
                $rows['phone'],
            ) : NULL;
        } catch (\Exception $error) {
            return NULL;
        }
    }

    public function updateManager(Manager $manager)
    {
        try {
            $this->query("
                UPDATE 
                    manager 
                SET 
                    name='$manager->name', 
                    phone='$manager->phone',  
                    commune_id='$manager->communeId', 
                    user_id='$manager->userId', 
                    address='$manager->address'
                WHERE
                    id='$manager->id' 
            ");

            return true;
        } catch (\Exception $error) {
            return false;
        }
    }

    public function addManager(Manager $manager)
    {
        try {
            $this->query("
                INSERT INTO manager 
                VALUES(
                    default, 
                    '$manager->name',
                    '$manager->communeId',  
                    '$manager->phone',  
                    '$manager->address',
                    '$manager->userId' 
                );
            ");

            return $this->getManager($this->lastInsertId());
        } catch (\Exception $error) {
            return NULL;
        }
    }

    public function getAll($page)
    {
        try {
            $response = $this->query("SELECT *FROM user WHERE access='manager' LIMIT " . Pagination::getStart($page) . " , " . Pagination::getEnd());
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
            $response = $this->query("SELECT COUNT(*) as total FROM user WHERE access='manager' ");

            $total = $response->fetchAll(\PDO::FETCH_ASSOC)[0]['total'];
            $pages = $total / Pagination::getEnd();

            return array('total' => $total, 'pages' => $pages);
        } catch (\Exception $error) {
            return 0;
        }
    }
}
