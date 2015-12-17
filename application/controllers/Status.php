<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Controller {

    public function index () {

        $match = array('id >' => 0);

        $result = $this->CRUD->read('statuses', $match);
        echo json_encode($result);
    
    }

}
