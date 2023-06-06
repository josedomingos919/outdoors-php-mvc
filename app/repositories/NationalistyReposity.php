<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\Nationality;

class NationalistyReposity extends PDOAdapter implements INationalityRepository
{
    public function getOne(int $id): Nationality
    {
        $response = $this->query("SELECT *FROM nationality WHERE id=$id");

        $rows = @$response->fetchAll(\PDO::FETCH_ASSOC)[0];

        return isset($rows) ? new Nationality($rows['id'], $rows['name']) : null;
    }

    public function getAll(): array
    {
        $provinces = [];
        $response  = $this->query("SELECT *FROM nationality");

        while ($row = $response->fetch(\PDO::FETCH_ASSOC)) {
            $provinces[] = new Nationality(
                $row['id'],
                $row['name']
            );
        }

        return $provinces;
    }
}
