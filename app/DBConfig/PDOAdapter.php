<?php

namespace App\DBConfig;

class PDOAdapter
{
    protected $db;

    private $host     = "localhost";
    private $dbname   = "outdoors";
    private $username = "root";
    private $password = "";

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
    }

    protected function lastInsertId()
    {
        return $this->db->lastInsertId();
    }

    protected function scape($param)
    {
        return $this->db->quote($param);
    }

    protected function query($query_string)
    {
        return $this->db->query($query_string);
    }
}
