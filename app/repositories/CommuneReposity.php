<?php

namespace App\Repositories;

use App\DBConfig\PDOAdapter;
use App\Model\Commune;

class CommuneReposity extends PDOAdapter implements ICommuneRepository
{
    public function getOne(int $id)
    {
        $response = $this->query("SELECT *FROM commune WHERE id=$id");

        $rows = @$response->fetch(\PDO::FETCH_ASSOC)[0];

        return isset($rows) ? new Commune($rows['id'], $rows['name'], $rows['municipality_id']) : null;
    }

    public function getAll(int $municipality_id): array
    {
        $communes = [];
        $response  = $this->query("SELECT *FROM commune WHERE municipality_id=$municipality_id");

        while ($row = $response->fetch(\PDO::FETCH_ASSOC)) {
            $communes[] = new Commune(
                $row['id'],
                $row['name'],
                $row['municipality_id']
            );
        }

        return $communes;
    }
}
