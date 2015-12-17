<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function check_errors()
    {
        $user_id = $this->session->userdata('user_id');

        if(!isset($user_id))
        {
            redirect('milagro');
        }
    }

    public function image_quality()
    {
        
    }

}
