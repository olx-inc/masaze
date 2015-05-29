<?php

class dbConnection {

    protected static $instance;

    protected $link;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new dbConnection();
        }
        return self::$instance;
    }

    public function executeQuery($query)
    {
        $this->getDbConnection();

        return $this->link->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function executeQueryInsert($query)
    {
        $this->getDbConnection();
        if (!$this->link->query($query)) {
            echo 'Could not perform query: ' . $query;
            exit;
        };

    }

    private function getDbConnection()
    {
        $dbCred = $this->getDbCredentials();

        if (!$this->link = new mysqli($dbCred['HOST'], $dbCred['USER'], $dbCred['PWD'], $dbCred['DBNAME'])) {
            echo 'Could not connect to mysql';
            exit;
        }
    }

    private function getDbCredentials()
    {
        $cred = array();

        $cred['HOST'] = '10.4.12.27';
        $cred['DBNAME'] = 'DB_MASAZE';
        $cred['USER'] = 'mtd';
        $cred['PWD'] = '_m7D#2015$';

        return $cred;
    }
}