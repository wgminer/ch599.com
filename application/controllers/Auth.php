<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function auth () {

        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $match = array(
            'email' => $email,
            'password' => $password
        );

        $results = $this->CRUD->read('users', $match); 

        if ($results) {

            $cookie = array(
                'id' => $results[0]->id,
                'email' => $results[0]->email,
                'logged_in' => true
            );

            $this->session->set_userdata($cookie);

            redirect('/admin', 'refresh');

        } else {
            redirect('/milagro', 'refresh');
        }
    }

    public function deauth () {

        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');

        redirect('/milagro', 'refresh');
    }

}


