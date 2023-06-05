<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\Municipality;

class MunicipalityReposity extends PDOAdapter implements IMunicipalityReposity
{
    public function getOne(int $id): Municipality
    {
        $response = $this->query("SELECT *FROM municipality WHERE id=$id");

        $rows = @$response->fetch(\PDO::FETCH_ASSOC)[0];

        return isset($rows) ? new Municipality($rows['id'], $rows['name'], $rows['province_id']) : null;
    }

    public function getAll(int $province_id): array
    {
        $municipalities = [];
        $response  = $this->query("SELECT *FROM municipality WHERE province_id='$province_id';");

        while ($row = $response->fetch(\PDO::FETCH_ASSOC)) {
            $municipalities[] =  new Municipality($row['id'], $row['name'], $row['province_id']);
        }

        return $municipalities;
    }
}
