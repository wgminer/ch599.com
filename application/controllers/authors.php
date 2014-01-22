<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authors extends CI_Controller {

    // APP CONTROLLERS

    public function index() {

    	redirect('latest');

    }

    // ADMIN CONTROLLERS

    public function join() {

        $data['title'] = 'Join';

        $this->load->view('admin/join', $data);

    }

    public function login() {

        $data['title'] = 'Login';

        $this->load->view('admin/login', $data);

    }

    public function create() {

    	$bio = $this->input->post('author_bio');
    	$email = $this->input->post('author_email');
        $name = $this->input->post('author_name');
        $password = md5($this->input->post('author_password'));
        $slug = url_title($name, 'dash', true);
        
        $data = array(
            'author_name' => $name,
            'author_slug' => $slug,
            'author_email' => $email,
            'author_password' => $password,
            'author_bio' => $bio,
            'author_created' => date('Y-m-d H:i:s'),
            'author_updated' => date('Y-m-d H:i:s')
        );

        if ($this->Author_model->create($data)) {

        	if ($valid = $this->Author_model->login($name, $password)) {

            	redirect('dashboard');

            }

        }

    }

    public function dashboard() {

        $this->Author_model->restricted();

        $data['genres'] = $this->Genre_model->all();
        $data['title'] = $this->session->userdata('author_name').'\'s Dashboard';
        $id = $this->session->userdata('author_id');

        if ($this->session->userdata('author_id') == 1) { //redirect to admin area
           
            redirect('admin');

        } else {

            $data['posts'] = $this->Post_model->get(array('post_author_id' => $id), '18446744073709551615', '0');
            $this->load->view('admin/dashboard', $data);

        }

    }

    public function settings() {

        $this->Author_model->restricted();

        $data['title'] = 'Settings';
        $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

        $this->load->view('admin/settings', $data);

    }

    public function update() {

        $this->Author_model->restricted();               

        $id = $this->input->post('author_id');
        $name = $this->input->post('author_name');
        $slug = url_title($name, 'dash', true);
        $email = $this->input->post('author_email');
        $bio = $this->input->post('author_bio');

        $data = array(
            'author_name' => $name,
            'author_slug' => $slug,
            'author_email' => $email,
            'author_bio' => $bio,
            'author_updated' => date('Y-m-d H:i:s')
        );

        if ($this->Author_model->update($id, $data)) {

            $data['success'] = 'Saved';
            $data['title'] = 'Settings';
            $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

            $this->load->view('admin/settings', $data);

        } else {

            $data['error'] = 'There was some kind of error...';
            $data['title'] = 'Settings';
            $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

            $this->load->view('admin/settings', $data);

        }

    }

    public function photo() {

        $this->Author_model->restricted();        

        $config['upload_path'] = './assets/img';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '1000';
        $config['max_width'] = '500';
        $config['max_height'] = '500';

        $this->load->library('upload', $config); 

        $id = $this->input->post('author_id'); 

        if ($this->upload->do_upload('author_photo')) {

            $photo = $this->upload->data();

            $data = array(
                'author_photo' => $photo['file_name'],
                'author_updated' => date('Y-m-d H:i:s')
            );

            if ($this->Author_model->update($id, $data)) {

                $data['success'] = 'Saved';
                $data['title'] = 'Settings';
                $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

                $this->load->view('admin/settings', $data);

            } else {

                $data['error'] = 'There was some kind of error...';
                $data['title'] = 'Settings';
                $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

                $this->load->view('admin/settings', $data);

            }
        
        } else {

            print 'Your file upload didn\'t work b...hit the back buttona and try again';
            print($this->upload->display_errors());

        }
    }

    public function password() {

        $this->Author_model->restricted();           

        $id = $this->input->post('author_id');
        $old = md5($this->input->post('author_old_password'));
        $new = md5($this->input->post('author_new_password'));

        if ($this->Author_model->get(array('author_id' => $id, 'author_password' => $old))) {

            $data = array(
                'author_password' => $new
            );

            if ($this->Author_model->update($id, $data)) {

                $data['success'] = 'Password Updated';
                $data['title'] = 'Settings';
                $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

                $this->load->view('admin/settings', $data);

            } else {

                $data['error'] = 'There was some kind of error...';
                $data['title'] = 'Settings';
                $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

                $this->load->view('admin/settings', $data);

            }
        
        } else {

            $data['error'] = 'Not your current password...';
            $data['title'] = 'Settings';
            $data['author'] = $this->Author_model->get(array('author_id' => $this->session->userdata('author_id')));

            $this->load->view('admin/settings', $data);

        }

    }

    public function validate() {

        $name = $this->input->post('author_name');
        $password = md5($this->input->post('author_password'));
        $valid = $this->Author_model->login($name, $password);

        if ($valid) {

            redirect('/dashboard', 'refresh');

        } else {

            $data['title'] = 'Login';
            $data['error'] = 'That isn\'t correct...';
            $this->load->view('admin/login', $data);

        } 

    }

    public function admin() {


    }

    public function logout() {
        $this->session->unset_userdata('author_id');
        $this->session->unset_userdata('author_name');
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('milagro', 'refresh');
    }

}