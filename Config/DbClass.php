<?php

class DbHandler
{
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $dbHost;
    public $dbObject;

    public function __construct($dbUsername, $dbPassword, $dbName, $dbHost)
    {
        $this->$dbUsername = $dbUsername;
        $this->$dbPassword = $dbPassword;
        $this->$dbName = $dbName;
        $this->$dbHost = $dbHost;
        $this->connectToDb();
    }
    private function connectToDb()
    {
        $this->dbObject = new mysqli(
            "localhost",//$this->dbHost,
            "root",//$this->dbUsername,
            "",//$this->dbPassword,
            "clinic_management"//$this->dbName
        );
        if ($this->dbObject->connect_error) {
            die('Error : (' . $this->dbObject->connect_errno . ') ' . $this->dbObject->connect_error);
        }
    }
}
