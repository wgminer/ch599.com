<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function auth () {

        $email = $this->input->post('email');
        // $password = md5($this->input->post('password'));

        $match = array(
            'email' => $email
        );

        $results = $this->CRUD->read('users', $match);

        // if ($results) {

        $cookie = array(
            'id' => '2',
            'email' => 'wgminer@gmail.com',
            'logged_in' => true
        );

        $this->session->set_userdata($cookie);

        // redirect('/dashboard', 'refresh');

        // } else {
        //     redirect('/milagro', 'refresh');
        // }
    }

    public function deauth () {

        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');

        redirect('/latest', 'refresh');
    }

}


