<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

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
            redirect('milagro');
        }
    }

    public function admin()
    {
        $user_id = $this->session->userdata('user_id');

        $data['genres'] = $this->CRUD->read('genres', array('id >' => 0));

        $this->load->view('admin', $data);
    }

}
