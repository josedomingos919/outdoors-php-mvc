<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\Manager;

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
                    '$manager->id', 
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
}
