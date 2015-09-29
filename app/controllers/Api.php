<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->is_authed();
    }

    public function is_authed()
    {
        $user_id = $this->session->userdata('user_id');

        if(!isset($user_id))
        {   
            header('HTTP', TRUE, 401);
            return false;
        }
    }

    public function dashboard()
    {
        $user_id = $this->session->userdata('user_id');

        $data['user'] = $this->CRUD->read('users', array('id' => $user_id));
        $data['songs'] = $this->CRUD->read('songs', array('user_id' => $user_id));

        $this->load->view('dashboard', $data);
    }


    // AJAX ROUTES

    public function search($slug)
    {
        $this->load->view('post');
    }
}
