<?php

    class Connection
    {
        private const HOST = "127.0.0.1", PASS = "", DB_NAME = "dontpad_db", USER = "root";
        private $connection;
        public function __construct()
        {
            try {
                $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";", self::USER, self::PASS, [ PDO::ATTR_PERSISTENT => true]);
            } catch (Error $e) {
                header("Location: " . ERROR_PAGE);
            }
        }
        public function getConnection() : PDO
        {
            return $this->connection;
        }
    }