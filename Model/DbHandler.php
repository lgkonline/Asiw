<?php

namespace Asiw\Model
{
    use \PDO;
    use \RecursiveArrayIterator;

    class DbHandler
    {
        public $Connection;

        function __construct()
        {
            $this->Connect();
        }

        public function Connect()
        {
            $dbConfig = \Asiw\Config::$DbConfig;
            
            try
            {
                $this->Connection = new PDO("mysql:host=" . $dbConfig["ServerName"] . ";dbname=" . $dbConfig["DbName"], $dbConfig["UserName"], $dbConfig["Password"]);
                $this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);             
            }
            catch (PDOException $ex)
            {
                echo "DataBase Connection failed: " . $ex->getMessage();
            }
        }
    }
}