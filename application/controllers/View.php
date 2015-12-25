<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function is_authed($redirect) {

        $user_id = $this->session->userdata('id');

        if (!isset($user_id) && $redirect) {   
            redirect('/milagro', 'refresh');
        } else {
            return $this->CRUD->read('users', array('id' => $user_id))[0]; 
        }
    }

    public function index () {
        redirect('/latest', 'refresh');
    }

    public function dashboard () {
        $data['admin'] = true;
        $data['user'] = $this->is_authed(true);
        $data['title'] = 'Dashboard';
        $this->load->view('dashboard', $data);
    }

    public function profile () {
        $data['admin'] = true;
        $data['user'] = $this->is_authed(true);
        $data['title'] = 'Profile';
        $this->load->view('profile', $data);
    }

    public function login () {
        $data['user'] = $this->is_authed(false);
        $data['title'] = 'Login';
        $this->load->view('login', $data);
    }

    public function latest () {

        $data['user'] = $this->is_authed(false);
        $data['title'] = 'Latest';

        if ($this->input->get('offset', true)) {
            $offset = $this->input->get('offset', true);
        } else {
            $offset = 0;
        }

        
        $data['songs'] = $this->CRUD->read('songs', array('songs.id >' => 0), $this->config->item('limit'), $offset); 

        foreach ($data['songs'] as $song) {
            $song->text = $this->Format->parseTwitter($song->text);
            $song->created_at = date_format(date_create($song->created_at), 'Y-m-d');
        }

        if ($this->input->get('ajax', true)) {
            $this->load->view('partials/songs', $data);
        } else {
            $this->load->view('feed', $data);
        }

    }

    public function authors () {
        $data['user'] = $this->is_authed(false);
        $data['title'] = 'Authors';
        $this->load->view('authors', $data);
    }

    public function genre ($slug) {

        $data['user'] = $this->is_authed(false);

        if ($this->input->get('offset', true)) {
            $offset = $this->input->get('offset', true);
        } else {
            $offset = 0;
        }
        
        $data['genre'] = $this->CRUD->read('genres', array('slug' => $slug))[0];

        $data['songs'] = $this->CRUD->read('songs', array('genres.slug' => $slug), $this->config->item('limit'), $offset); 
        $data['title'] = $data['songs'][0]->genre_name;

        foreach ($data['songs'] as $song) {
            $song->text = $this->Format->parseTwitter($song->text);
            $song->created_at = date_format(date_create($song->created_at), 'Y-m-d');
        }

        if ($this->input->get('ajax', true)) {
            $this->load->view('partials/songs', $data);
        } else {
            $this->load->view('genre', $data);
        }

    }

    public function author ($slug) {

        $data['user'] = $this->is_authed(false);

        if ($this->input->get('offset', true)) {
            $offset = $this->input->get('offset', true);
        } else {
            $offset = 0;
        }

        $data['author'] = $this->CRUD->read('users', array('slug' => $slug))[0];
        $data['author']->bio = $this->Format->parseTwitter($data['author']->bio);

        $data['songs'] = $this->CRUD->read('songs', array('users.slug' => $slug), $this->config->item('limit'), $offset); 
        $data['title'] = $data['songs'][0]->user_name;

        foreach ($data['songs'] as $song) {
            $song->text = $this->Format->parseTwitter($song->text);
            $song->created_at = date_format(date_create($song->created_at), 'Y-m-d');
        }

        if ($this->input->get('ajax', true)) {
            $this->load->view('partials/songs', $data);
        } else {
            $this->load->view('author', $data);
        }

    }

}
