<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenreController extends CI_Controller {

    public function index () {

        $match = array('id >' => 0);

        $result = $this->CRUD->read('genres', $match);
        echo json_encode($result);
    
    }

}
