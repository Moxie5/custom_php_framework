<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

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
