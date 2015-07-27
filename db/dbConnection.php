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

        if (!$this->link = new mysqli($dbCred['host'], $dbCred['user'], $dbCred['pass'], $dbCred['path'], $dbcred['port'])) {
            echo 'Could not connect to mysql';
            exit;
        }
    }

    private function getDbCredentials()
    {
        $cred = parse_url(getenv('DATABASE_URL')?:'mysql2://mtd:_m7D#2015$@10.4.12.27:3306/DB_MASAZE');
        $cred['path'] = str_replace('/', '', $cred['path']);

        return $cred;
    }
}