<?php

namespace App\Models\Clients;

use App\Core\Models;

class Clients_Model extends Models
{

    public $db;

    public function get_clients()
    {
        $this->db->query("SELECT * FROM clients");
        // $this->db->bind(':username', $username);
        $row = $this->db->single();
        // $this->db->rowCount();
        return $row;
    }
}
