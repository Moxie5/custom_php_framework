<?php

namespace App\Core;

use App\Library\DataBase;

abstract class Models
{
    public $db;

    public function __construct()  
    {
        $this->db = new DataBase;
    }
}
