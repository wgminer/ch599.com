<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends CI_Controller {

    public function index () 
    {
        redirect('/latest', 'refresh');
    }

    public function latest ()
    {
        $this->load->view('channel');
    }

    public function genre ($slug)
    {
        $this->load->view('channel');
    }

    public function author ($slug)
    {
        $this->load->view('channel');
    }

}
