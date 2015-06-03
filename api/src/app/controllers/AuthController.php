<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {

    public function __construct()
    {
        parent::CI_Controller();
        if (! $this->session->userdata('user_id'))
        {
            redirect('milagro');
        }
    }

}


