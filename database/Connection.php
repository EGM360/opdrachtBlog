<?php

namespace database;

use PDO;

class Connection
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "opdracht3";

    public readonly PDO $pdo;

    public function __construct() {
        $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo = $pdo;

    }
}