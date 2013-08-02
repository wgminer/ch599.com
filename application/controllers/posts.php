<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct() {

        parent::__construct();
        
        $this->load->model('Post_model');
        $this->load->model('User_model');

    }

    public $limit = 2; //DEFAULT LIMIT

    public $offset = 0; //DEFAULT OFFSET

    public function index() {

        redirect('latest');

    }

    public function playlist($filter) {

        $data['authors'] = $this->User_model->get('All');
        $data['autoplay'] = false;
        $data['title'] = ucfirst($filter) . ' | Channel 599';

        if (!isset($_POST['offset'])) { // DEFAULT LOADING

            if ($filter == 'latest') { // ALL

                $data['controls'] = true;
                $data['posts'] = $this->Post_model->get(array('post_status' => 'published'), $this->limit, $this->offset);

                if (count($data['posts']) >= $this->limit){ // IF ENOUGH SONGS ARE RETURNED TO REQUIRE PAGINATION SET UP PAGINATION BUTTON

                    $data['pagination'] = $filter;

                }

                $this->load->view('app/index', $data);

            } elseif ($filter == 'promoted') { // POPULAR

                // HOW DO WE DO THIS

            } elseif ($filter == 'songs') { // SONGS

                $data['controls'] = true;
                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_type' => 'song'), $this->limit, $this->offset);

                if (count($data['posts']) >= $this->limit){ // IF ENOUGH SONGS ARE RETURNED TO REQUIRE PAGINATION SET UP PAGINATION BUTTON

                    $data['pagination'] = $filter;

                }

                $this->load->view('app/index', $data);

            } elseif ($filter == 'sets') { // SETS

                $data['controls'] = false;
                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_type' => 'set'), $this->limit, $this->offset);

                if (count($data['posts']) >= $this->limit){ // IF ENOUGH SONGS ARE RETURNED TO REQUIRE PAGINATION SET UP PAGINATION BUTTON

                    $data['pagination'] = $filter;

                }

                $this->load->view('app/index', $data);

            } elseif ($data['author'] = $this->User_model->get(array('user_name' => $filter))) { // AUTHORS

                $data['controls'] = true;
                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_author' => $filter), $this->limit, $this->offset);

                if (count($data['posts']) >= $this->limit){ // IF ENOUGH SONGS ARE RETURNED TO REQUIRE PAGINATION SET UP PAGINATION BUTTON

                    $data['pagination'] = $filter;

                }

                $this->load->view('app/author', $data);

            // } elseif ($this->Favorite_model->isGenre($filter)) { // GENRES

            //     $data['controls'] = true;
            //     $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_type' => $filter), $this->limit, $this->offset);

            //     if (count($data['posts']) >= $this->limit){ // IF ENOUGH SONGS ARE RETURNED TO REQUIRE PAGINATION SET UP PAGINATION BUTTON

            //         $data['pagination'] = $filter;

            //     }

            //     $this->load->view('app/genre', $data);

            } else { // MUST BE A POST THEN...

                $this->post($filter);

            }

        } else { // PAGINATION LOADING

            $offset = $_POST['offset'];

            if ($filter == 'latest') { // LATEST

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published'), $this->limit, $offset);

            } elseif ($filter == 'songs') { // SONGS

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_type' => 'song'), $this->limit, $offset);

            } elseif ($filter == 'sets') { // SETS

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_type' => 'set'), $this->limit, $offset);

            } elseif ($this->User_model->get(array('user_name' => $filter))) { // AUTHORS

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_author' => $filter), $this->limit, $offset);

            } elseif ($this->Favorite_model->isGenre($filter)) { // GENRES

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_type' => 'set'), $this->limit, $offset);

            }

            if (count($data['posts']) >= $this->limit){

                $data['offset'] = $offset+$this->limit;

                $this->load->view('app/includes/posts', $data);

            } else {

                $this->load->view('app/includes/posts', $data);
                
            }

        }

    }

    public function post($id) {

        if (!isset($_POST['autoplay'])) {

            $data['authors'] = $this->User_model->get('All');
            $data['autoplay'] = true;

            if ($data['post'] = $this->Post_model->get(array('post_mini_url' => $id), '1', '0')) { // REDIRECT MINI URL TO SLUG

                redirect($data['post']->post_slug); 

            } elseif ($data['post'] = $this->Post_model->get(array('post_slug' => $id), '1', '0')) { // LOAD POST BY SLUG

                $data['controls'] = false;
                $data['title'] = $data['post']->post_title;

                $this->load->view('app/single', $data);

            } else {

                show_404();

            }

        } else {

            // GET RANDOM OR NEXT DEPENDING ON POST VALUE

        }

    }

    public function compose() {

        $this->User_model->restricted();

        $data['title'] = 'New Post';
        $data['user'] = $this->session->userdata('user_name');

        $this->load->view('admin/compose', $data);

    }

    public function create() {

        $type = $this->input->post('post_type');
        $title = $this->input->post('post_title');
        $slug = url_title($title, 'dash', true);
        $url = $this->input->post('post_media');
        $status = $this->input->post('post_status');
        $text = $this->input->post('post_text');
        $author = $this->input->post('post_author');
        $mini = $this->Post_model->mini_url();

        if (strpos($url, 'youtube') !== false) {
            
            $media = substr($url, strrpos($url, '?v=' ) + 3, 11);
            $img = 'http://img.youtube.com/vi/'.$media.'/hqdefault.jpg';
            $source = 'youtube';
        
        } elseif (strpos($url, 'soundcloud') !== false) { 

            $client = 'e9fc1d5a435447d40bb665d017a6cd9a';
            $escaped_url = mysql_real_escape_string($url);
            $json = file_get_contents('http://api.soundcloud.com/resolve.json?client_id='.$client.'&url='.$escaped_url);

            $media = json_decode($json)->permalink_url;
            $img = substr(json_decode($json)->artwork_url, 0, -18).'-t500x500.jpg';
            $source = 'soundcloud';

        } else {

            print 'Unsupported';

        }

        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_media' => $media,
            'post_img' => $img,
            'post_text' => $text,
            'post_author' => $author,
            'post_type' => $type,
            'post_source' => $source,
            'post_status' => $status,
            'post_mini_url' => $mini,
            'post_created' => date('Y-m-d H:i:s'),
            'post_updated' => date('Y-m-d H:i:s')
        );

        if ($this->Post_model->create($data)) {

            redirect('dashboard');

        }

    }

    public function edit($id) {

        $data['post'] = $this->Post_model->get(array('post_id' => $id));
        $data['title'] = 'Edit: ' . $data['post']->post_title;

        $this->load->view('admin/edit', $data);

    }

    public function update() {

        $id = $this->input->post('post_id');
        $type = $this->input->post('post_type');
        $title = $this->input->post('post_title');
        $slug = url_title($title, 'dash', true);
        $url = $this->input->post('post_media');
        $status = $this->input->post('post_status');
        $text = $this->input->post('post_text');

        if (strpos($url, 'youtube') !== false) {
            
            $media = substr($url, strrpos($url, '?v=' ) + 3, 11);
            $img = 'http://img.youtube.com/vi/'.$media.'/hqdefault.jpg';
            $source = 'youtube';
        
        } elseif (strpos($url, 'soundcloud') !== false) { 

            $client = 'e9fc1d5a435447d40bb665d017a6cd9a';
            $escaped_url = mysql_real_escape_string($url);
            $json = file_get_contents('http://api.soundcloud.com/resolve.json?client_id='.$client.'&url='.$escaped_url);

            $media = json_decode($json)->permalink_url;
            $img = substr(json_decode($json)->artwork_url, 0, -18).'-t500x500.jpg';
            $source = 'soundcloud';

        } else {

            print 'Unsupported';

        }

        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_media' => $media,
            'post_img' => $img,
            'post_text' => $text,
            'post_type' => $type,
            'post_source' => $source,
            'post_status' => $status,
            'post_updated' => date('Y-m-d H:i:s')
        );

        if ($this->Post_model->update($id, $data)) {

            $data['post'] = $this->Post_model->get(array('post_id' => $id));
            $data['success'] = 'Updated Successfully!';
            $data['title'] = 'Edit: ' . $data['post']->post_title;

            $this->load->view('admin/edit', $data);

        }

    }

    public function delete() {

    }

}