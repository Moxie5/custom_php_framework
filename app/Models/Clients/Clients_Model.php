<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Models\Clients;

use App\Core\Models;

class Clients_Model extends Models
{

    public $db;

    public function get_clients()
    {
        $this->db->query("SELECT * FROM users");
        // $this->db->bind(':username', $username);
        $row = $this->db->single();
        // $this->db->rowCount();
        return $row;
    }
}
