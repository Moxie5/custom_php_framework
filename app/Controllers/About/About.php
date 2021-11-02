<?php

namespace App\Controllers\About;

use App\Core\Controller;

class About extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = $this->Model('Clients_Model');
    }

    public function about()
    {
        /**
         *  Local Model and use mothod get_clients
         */
        // $this->session->setSession('success', 'Testing Session');

        // $data['data'] = $this->request->get();
        // $data['data'] = $this->model->get_clients();
        $data['data'] = '';

        $this->view->render('about/about', $data);
    }
}
