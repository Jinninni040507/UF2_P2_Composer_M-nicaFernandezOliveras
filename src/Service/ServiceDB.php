<?php

namespace App\Service;

use App\Exceptions\DatabaseException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use mysqli;

class ServiceDB
{
    public $log;
    public function __construct()
    {
        $this->log = new Logger('mi_logger');
        $this->log->pushHandler(new StreamHandler("../../logs/app_workshop.log", Level::Info));
    }
    public function connect(): mysqli
    {

        try {
            $keys = parse_ini_file("../../cfg/db_config.ini");
            $conection = new mysqli($keys['host'], $keys['username'], $keys['password'], $keys['dbname'], $keys['port']);
        } catch (\Throwable $th) {
            $this->log->error("Database couldn't connect");
            throw new DatabaseException("Couldn't connect to database");
        }


        return $conection;
    }
}
