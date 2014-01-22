<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends CI_Controller {

	public function sitemap() {

        $data['authors'] = $this->Author_model->getActive();    
        $data['genres'] = $this->Genre_model->getActive(); 
        $data['posts'] = $this->Post_model->get(array('post_status' => 'published'), '1000000', '0');

        header("Content-Type: text/xml;charset=iso-8859-1");
        $this->load->view('admin/sitemap', $data);

    }


}

?>