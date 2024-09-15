<?php
require_once 'config.php';
class Database
{
    public function connect()
    {
        $db = new PDO("mysql:host=" . env('DB_HOST') . ";dbname=" . env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));
        return $db;
    }
}
