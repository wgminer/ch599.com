<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteController extends CI_Controller {

    public function index()
    {
        $match = array(
            'songs.id > ' => 0,
        );
        $data['songs'] = $this->CRUD->read('songs', $match);

        foreach ($data['songs'] as $song) {
            $annotations = $this->CRUD->read('annotations', array('song_id' => $song->id)); 
            $song->annotations = $annotations;
        }


        $this->load->view('playlist', $data);
    }

    public function author($author)
    {
        $match = array(
            'user_id >' => $id,
        );
        $this->load->view('playlist', $data);
    }

    public function genre($genre)
    {
        $match = array(
            'genre_id >' => $id,
        );
        $this->load->view('playlist', $data);
    }

    public function post($slug)
    {
        $this->load->view('post');
    }

    // AJAX ROUTES

    public function search($slug)
    {
        $this->load->view('post');
    }
}
