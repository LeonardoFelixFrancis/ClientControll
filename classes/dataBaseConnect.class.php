<?php

class dataBaseConnect{
    protected $host = "localhost";
    protected $dbUser = "root";
    protected $dbPwd = "";
    protected $dataBase = "phptest";

    protected function makeConnection(){
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dataBase;
        $pdo = new PDO($dsn, $this->dbUser, $this->dbPwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;           
    }
}