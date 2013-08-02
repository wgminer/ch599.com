<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Post_model');
        $this->load->model('User_model');
    }

    public function index() {

    }

    public function profile() {
    	
    }

    public function join() {

        $data['title'] = 'Join';

        $this->load->view('admin/join', $data);

    }

    public function login() {

        $data['title'] = 'Login';

        $this->load->view('admin/login', $data);

    }

    public function create() {

        // $config['upload_path'] = './assets/img';
        // $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size'] = '100';
        // $config['max_width'] = '1024';
        // $config['max_height'] = '768';
        // $this->load->library('upload', $config);

        $name = $this->input->post('user_name');
        $slug = url_title($name, 'dash', true);
        $email = $this->input->post('user_email');
        $password = md5($this->input->post('user_password'));
        $bio = $this->input->post('user_bio');

        $data = array(
            'user_name' => $name,
            'user_slug' => $slug,
            'user_email' => $email,
            'user_password' => $password,
            'user_bio' => $bio,
            'user_created' => date('Y-m-d H:i:s'),
            'user_updated' => date('Y-m-d H:i:s')
        );

        if ($this->User_model->create($data)) {

            redirect('login');

        }

    }

    public function dashboard() {

        $this->User_model->restricted();

        $data['title'] = $this->session->userdata('user_name').'\'s Dashboard';
        $data['posts'] = $this->Post_model->get(array('post_author' => $this->session->userdata('user_name')), '18446744073709551615', '0');

        $this->load->view('admin/dashboard', $data);

    }

    public function settings() {

        $this->User_model->restricted();

        $data['title'] = 'Settings';
        $data['user'] = $this->User_model->get(array('user_id' => $this->session->userdata('user_id')));

        $this->load->view('admin/settings', $data);

    }

    public function update() {

        $this->User_model->restricted();        

        $config['upload_path'] = './assets/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';

        $this->load->library('upload', $config);        

        $id = $this->input->post('user_id');
        $name = $this->input->post('user_name');
        $slug = url_title($name, 'dash', true);
        $email = $this->input->post('user_email');
        $bio = $this->input->post('user_bio');

        if ($this->upload->do_upload('user_photo')) {

            $photo = $this->upload->data();

            $data = array(
                'user_name' => $name,
                'user_slug' => $slug,
                'user_email' => $email,
                'user_photo' => $photo['file_name'],
                'user_bio' => $bio,
                'user_updated' => date('Y-m-d H:i:s')
            );

            if ($this->User_model->update($id, $data)) {

                $data['success'] = 'Saved';
                $data['title'] = 'Settings';
                $data['user'] = $this->User_model->get(array('user_id' => $this->session->userdata('user_id')));

                $this->load->view('admin/settings', $data);

            } else {

                $data['error'] = 'Not saved...';
                $data['title'] = 'Settings';
                $data['user'] = $this->User_model->get(array('user_id' => $this->session->userdata('user_id')));

                $this->load->view('admin/settings', $data);

            }
        
        } else {
            print($this->upload->display_errors());
            var_dump($this->upload->do_upload('user_photo'));

        }

    }

    public function validate() {

        $name = $this->input->post('user_name');
        $password = md5($this->input->post('user_password'));
        $valid = $this->User_model->login($name, $password);

        if ($valid) {

            redirect('/dashboard', 'refresh');

        } else {

            $data['title'] = 'Login';
            $data['error'] = 'That isn\'t correct...';
            $this->load->view('admin/login', $data);

        } 

    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }

}