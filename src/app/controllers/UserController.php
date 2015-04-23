<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function register()
    {
        $this->load->view('register');
    }

    public function create()
    {
        $bio = $this->input->post('bio');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $password = md5($this->input->post('password'));
        $slug = url_title($name, 'dash', true);
        
        $data = array(
            'name' => $name,
            'slug' => $slug,
            'email' => $email,
            'password' => $password,
            'bio' => $bio
        );

        if ($user = $this->CRUD->create('users', $data)) {
            var_dump($user);
        }
    }

    public function settings()
    {
        $this->load->view('settings');
    }

    public function update()
    {   
        $id = $this->input->post('id');
        $bio = $this->input->post('bio');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $password = md5($this->input->post('password'));
        $slug = url_title($name, 'dash', true);
        
        $data = array(
            'name' => $name,
            'slug' => $slug,
            'email' => $email,
            'password' => $password,
            'bio' => $bio
        );

        if ($user = $this->CRUD->update('users', $id, $data)) {
            var_dump($user);
        }
    }

    public function login()
    {
        $this->load->view('login');
    }

    public function auth()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $match = array(
            'email' => $email,
            'password' => $password,
        );
        
        $result = $this->CRUD->read('users', $match);

        if ($result) {

            $cookie = array(
                'user_id' => $result[0]->id,
            );
            $this->session->set_userdata($cookie);

            redirect('admin');
        } else {
            echo 'invalid';
        }
    }

    public function deauth()
    {
        $this->load->view('welcome_message');
    }
}
