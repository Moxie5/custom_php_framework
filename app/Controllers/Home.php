<?php
/**
 * User: Moxie5
 * Author: Dobromir Dobrev
 * Created with educational purposes 
 */

namespace App\Controllers;

use App\Core\Controller;

class Home extends Controller
{
    public function __construct()
    {
        parent::__construct(); 
    }

    public function index()
    {
        //Set up custom layout 
        // $this->view->layout = 'custom';

        //Load Model use \ for subfolder
        // $data['data'] = $this->loadModel('Clients\Clients_Model')->get_clients();
        // $data['data'] = $this->loadModel('Clients_Model')->get_clients();
        $data['data'] = '';
        $this->view->render('home', $data);
    }
}
