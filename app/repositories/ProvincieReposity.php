<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\Province;

class ProvinceRepository extends PDOAdapter implements IProvinceRepository
{
    public function getOne(int $id)
    {
        $response = $this->query("SELECT *FROM province WHERE id=$id");

        $rows = @$response->fetch(\PDO::FETCH_ASSOC)[0];

        return isset($rows) ? new Province($rows['id'], $rows['name']) : null;
    }

    public function getAll(): array
    {
        $provinces = [];
        $response  = $this->query("SELECT *FROM province");

        while ($row = $response->fetch(\PDO::FETCH_ASSOC)) {
            $provinces[] = new Province(
                $row['id'],
                $row['name']
            );
        }

        return $provinces;
    }
}
