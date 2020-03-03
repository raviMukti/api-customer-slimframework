<?php

class db{
    //Props
    private $dbhost = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'db_slim';

    //connect
    public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->user, $this->password);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}