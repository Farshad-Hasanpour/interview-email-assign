<?php

namespace php_class\traits;

trait ConnectionSetting{
    private $drive = 'mysql';
    private $host = 'localhost';
    private $dbname = '';
    private $charset = 'utf8';
    private $dbuser = '';
    private $dbpass = '';
    private $conn;
    public function __construct() {
        try {
            $this->conn = new \PDO("$this->drive:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->dbuser, $this->dbpass);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (\PDOException $ex){
            die($ex->getMessage()." code line: ".__LINE__);
        }
    }
}