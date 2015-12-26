<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo extends CI_Controller {

    public function index () {

        $data['genres'] = $this->CRUD->read('genres', array('id >' => 0));
        $data['authors'] = $this->CRUD->read('users', array('id >' => 1));
        $data['songs'] = $this->Post_model->get(array('song.status_id' => 1), '1000000', '0');

        header("Content-Type: text/xml;charset=iso-8859-1");

        $this->load->view('sitemap', $data);
    
    }

}
