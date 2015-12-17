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

    public function index () 
    {
        redirect('/latest', 'refresh');
    }

    public function admin ()
    {
        $data['user'] = $this->is_authed(true);
        $this->load->view('admin', $data);
    }

    public function login ()
    {
        $this->load->view('login');
    }

    public function latest ()
    {
        $data['user'] = $this->is_authed(false);
        $data['songs'] = $this->CRUD->read('songs', array('songs.id >' => 0), 20); 

        foreach ($data['songs'] as $song) {
            // $song->title = $this->Format->segmentTitle($song->title);
            $song->text = $this->Format->parseTwitter($song->text);
        }

        // foreach ($data['songs'] as $song) {
        //     $song->color = $this->Color->sample($song->id, $song->image_url);
        // }

        $this->load->view('feed', $data);
    }

    public function genre ($slug)
    {
        $this->load->view('genre');
    }

    public function user ($slug)
    {
        $this->load->view('user');
    }

}
