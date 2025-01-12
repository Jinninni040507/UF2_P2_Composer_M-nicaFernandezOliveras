<?php

namespace App\Service;

use App\Model\Reparation;
use mysqli;

class ServiceDB
{
    public function connect(): mysqli
    {
        $keys = parse_ini_file("../../cfg/db_config.ini");
        $conection = new mysqli($keys['host'], $keys['username'], $keys['password'], $keys['dbname'], $keys['port']);

        return $conection;
    }
}
