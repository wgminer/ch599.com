<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

    public function is_authed()
    {
        $user_id = $this->session->userdata('id');

        if(!isset($user_id))
        {   
            redirect('/milagro', 'refresh');
        }
    }

    public function index ()
    {
        $this->is_authed();
        $this->load->view('admin');
    }

    public function login ()
    {
        $this->load->view('login');
    }

    public function auth ()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $match = array(
            'email' => $email,
            'password' => $password
        );

        $results = $this->CRUD->read('users', $match); 

        if ($results) {

            // var_dump($results);

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

    public function deauth ()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        echo $email . ' ' . $password;
    }

}


