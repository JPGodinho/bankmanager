<?php

class Database {

    private static $host;
    private static $dbName;
    private static $username;
    private static $password;

    private static $connection;

    public static function connect() {

        self::$host = getenv('MYSQL_HOST') ?: 'localhost';
        self::$dbName = getenv('MYSQL_DATABASE') ?: 'bankmanager';
        self::$username = getenv('MYSQL_USER') ?: 'root';
        self::$password = getenv('MYSQL_PASSWORD') ?: '';

        if(!isset(self::$connection) ) {
            try {
                self::$connection = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                    self::$username,
                    self::$password
                );

                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar" . $e->getMessage());
            }
        }

        return self::$connection;
    }

}