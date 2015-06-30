<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

    public function index ($id = false) {
        
        $match = array('id >' => 0);

        if ($id) {
            $match = array('id' => $id);
        }

        $results = $this->CRUD->read('users', $match); 

        if ($results != false) {
            echo json_encode($results);
        } else {
            echo json_encode([]);
        }        
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

    public function update ($id) {

        $input = json_decode(trim(file_get_contents('php://input')), true);

        $match = array('id' => $id);
        
        $user = array(
            'name' => $input['name'],
            'slug' => url_title($input['name'], 'dash', true),
            'email' => $input['email'],
            'bio' => $input['bio']
        );

        $updated = $this->CRUD->update('users', $match, $user);
        echo json_encode($updated);
    }

    public function update_password ($id) {

        $input = json_decode(trim(file_get_contents('php://input')), true);

        $match = array('id' => $id);
        
        $user = array(
            'password' => md5($input['new'])
        );

        $updated = $this->CRUD->update('users', $match, $user);
        echo json_encode(true);
    }
}
