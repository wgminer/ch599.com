<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends CI_Controller {

    // APP CONTROLLERS

    public function index() {

        redirect('latest');

    }

    public function router($filter) {

        $data['authors'] = $this->Author_model->getActive();    
        $data['genres'] = $this->Genre_model->getActive(); 
        $data['title'] = ucfirst($filter) . ' | Channel 599';

        if (!isset($_POST['offset'])) { // DEFAULT

        	$data['offset'] = $this->config->item('limit');

            if ($filter == 'latest') { // LATEST

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_source' => 'youtube'), $this->config->item('limit'), $this->config->item('offset'));
                $data['remaining'] = $this->Post_model->get(array('post_status' => 'published', 'post_source' => 'youtube'), $this->config->item('limit')+1, $this->config->item('offset'));

                if (count($data['remaining']) > $this->config->item('limit')){

                    $data['pagination'] = $filter;

                }

                $data['title'] = 'Channel 599'; // Override...

                $this->load->view($this->Post_model->device().'/index', $data);

            } elseif ($data['author'] = $this->Author_model->get(array('author_slug' => $filter))) { // AUTHOR

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_author_id' => $data['author']->author_id, 'post_source' => 'youtube'), $this->config->item('limit'), $this->config->item('offset'));
                $data['remaining'] = $this->Post_model->get(array('post_status' => 'published', 'post_author_id' => $data['author']->author_id, 'post_source' => 'youtube'), $this->config->item('limit')+1, $this->config->item('offset'));

                if (count($data['remaining']) > $this->config->item('limit')){

                    $data['pagination'] = $filter;

                }

                $this->load->view($this->Post_model->device().'/author', $data);

            } elseif ($data['genre'] = $this->Genre_model->get(array('genre_slug' => $filter))) { // GENRE

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_genre_id' => $data['genre']->genre_id, 'post_source' => 'youtube'), $this->config->item('limit'), $this->config->item('offset'));
                $data['remaining'] = $this->Post_model->get(array('post_status' => 'published', 'post_genre_id' => $data['genre']->genre_id, 'post_source' => 'youtube'), $this->config->item('limit')+1, $this->config->item('offset'));

                if (count($data['remaining']) > $this->config->item('limit')){

                    $data['pagination'] = $filter;

                }

                $data['title'] = $data['genre']->genre_name . ' | Channel 599';

                $this->load->view($this->Post_model->device().'/genre', $data);

            } else { // POST

                $this->post($filter);

            }

        } else { // PAGINATION

            $offset = $_POST['offset'];

            if ($filter == 'latest') { // LATEST

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_source' => 'youtube'), $this->config->item('limit'), $offset);
                $data['remaining'] = $this->Post_model->get(array('post_status' => 'published', 'post_source' => 'youtube'), $this->config->item('limit')+1, $offset);

            } elseif ($data['author'] = $this->Author_model->get(array('author_slug' => $filter))) { // AUTHOR

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_author_id' => $data['author']->author_id, 'post_source' => 'youtube'), $this->config->item('limit'), $offset);
                $data['remaining'] = $this->Post_model->get(array('post_status' => 'published', 'post_author_id' => $data['author']->author_id, 'post_source' => 'youtube'), $this->config->item('limit')+1, $offset);

            } elseif ($data['genre'] = $this->Genre_model->get(array('genre_slug' => $filter))) { // GENRE

                $data['posts'] = $this->Post_model->get(array('post_status' => 'published', 'post_genre_id' => $data['genre']->genre_id, 'post_source' => 'youtube'), $this->config->item('limit'), $offset);
                $data['remaining'] = $this->Post_model->get(array('post_status' => 'published', 'post_genre_id' => $data['genre']->genre_id, 'post_source' => 'youtube'), $this->config->item('limit')+1, $offset);

            }

            if (count($data['remaining']) > $this->config->item('limit')){

                $data['offset'] = $offset+$this->config->item('limit');
                $data['pagination'] = $filter;

                $this->load->view($this->Post_model->device().'/includes/loop', $data);

            } else {

                $this->load->view($this->Post_model->device().'/includes/loop', $data);
                
            }

        }

    }
    public function post($id) {

        $data['authors'] = $this->Author_model->getActive();    
        $data['genres'] = $this->Genre_model->getActive(); 

        if ($data['post'] = $this->Post_model->get(array('post_mini_url' => $id), '1', '0')) { // REDIRECT MINI URL TO SLUG

            redirect($data['post']->post_slug); 

        } elseif ($data['post'] = $this->Post_model->get(array('post_slug' => $id, 'post_source' => 'youtube'), '1', '0')) { // LOAD POST BY SLUG

            $data['title'] = $data['post']->post_title;

            if ($data['post']->post_genre_id == 0) {

                $data['relatives'] = $this->Post_model->random('3');

            } else {

                $data['relatives'] = $this->Post_model->get(array('post_genre_id' => $data['post']->post_genre_id, 'post_source' => 'youtube'), '3', '0');
                $count = count($data['relatives']);

                if ( $count < 3 ) {

                    $data['relatives'] = $this->Post_model->random('3');

                }

            }

            $this->load->view($this->Post_model->device().'/single', $data);

        } else {

            show_404();

        }

    }

    public function autoplay() {

        if (isset($_POST['autoplay'])) {

            $type = $_POST['autoplay'];

            if ($type == 'shuffle') {

                $data['post'] = $this->Post_model->random('1');

            } else if ($type == 'good') {

                $data['post'] = $this->Post_model->good('1');

            } else {

                do {

                    $id = intval($_POST['autoplay']) - 1;

                    if ($id < 1) {

                        $data['post'] = $this->Post_model->get(array('post_status' => 'published', 'post_source' => 'youtube'), '1', '0');

                    } else {

                        $data['post'] = $this->Post_model->get(array('post_id' => $id, 'post_status' => 'published', 'post_source' => 'youtube'), '1', '0');

                    }

                } while ($data['post'] == false);

            }

            if ($data['post']->post_genre_id == 0) {

                $data['relatives'] = $this->Post_model->random('3');

            } else {

                $data['relatives'] = $this->Post_model->get(array('post_genre_id' => $data['post']->post_genre_id, 'post_source' => 'youtube'), '3', '0');
                $count = count($data['relatives']);

                if ( $count < 3 ) {

                    $data['relatives'] = $this->Post_model->random('3');

                }

            }

            $this->load->view($this->Post_model->device().'/includes/autoplay', $data);

        } else {

            print_r('Nothing Posted');
            die;

        }

    }

    public function playlist() {

        $data['authors'] = $this->Author_model->getActive();    
        $data['genres'] = $this->Genre_model->getActive(); 
        $data['title'] = 'Playlist | Channel 599';

        if (isset($_GET['q'])) {

            $id = $_GET['q'];

            $posts = explode(' ', $id);

            $data['posts'] = $this->Post_model->playlist($posts);

            $this->load->view($this->Post_model->device().'/index', $data);

        } else {



        }

    }

    public function search() {

        if (isset($_GET['q'])) {

            $term = $_GET['q'];

            if (strpos($term, ' ') !== false) {

                $terms = explode(' ', $term);

                foreach ($terms as $term) {
                    
                    $data['posts'] = $this->Post_model->search($term);

                }

            } else {

                $data['posts'] = $this->Post_model->search($term);

            }
            

            $data['authors'] = $this->Author_model->getActive();    
            $data['genres'] = $this->Genre_model->getActive(); 
            $data['title'] = '"'.$term.'" | Channel 599';

            $this->load->view($this->Post_model->device().'/search', $data);

        } else {

            print('nada');

        }

    }

    // ADMIN CONTROLLERS

    public function compose() {

        $this->Author_model->restricted();

        $data['author'] = $this->session->userdata('author_id');
        $data['genres'] = $this->Genre_model->all();
        $data['title'] = 'New Post';
        

        $this->load->view('admin/compose', $data);

    }

    public function create() {

        //$type = $this->input->post('post_type');
        $title = $this->input->post('post_title');
        $slug = url_title($title, 'dash', true);
        $url = $this->input->post('post_media');
        $status = $this->input->post('post_status');
        $text = $this->input->post('post_text');
        $genre_id = $this->input->post('post_genre');
        $author_id = $this->input->post('post_author');
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

            if (json_decode($json)->artwork_url == null) {
                $img = substr(json_decode($json)->user->avatar_url, 0, -18).'-t500x500.jpg';
            } else {
                $img = substr(json_decode($json)->artwork_url, 0, -18).'-t500x500.jpg';
            }

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
            'post_author_id' => $author_id,
            'post_type' => 'song',
            'post_genre_id' => $genre_id,
            'post_source' => $source,
            'post_status' => $status,
            'post_mini_url' => $mini,
            'post_created' => date('Y-m-d H:i:s'),
            'post_updated' => date('Y-m-d H:i:s')
        );

        if ($id = $this->Post_model->create($data)) {

            redirect('tweet?id='.$id);

        }

    }

    public function tweet() {

        $this->Author_model->restricted();

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $data['facebook'] = true;

            $data['post'] = $this->Post_model->get(array('post_id' => $id), '1', '0');
            $data['title'] = 'Tweet: ' . $data['post']->post_title;

            $this->load->view('admin/tweet', $data);

        } else {

            $data['facebook'] = false;
            $data['title'] = 'Compose Tweet ';
            $this->load->view('admin/tweet', $data);

        }

    }

    private $connection;
    public function post_tweet() {

        $facebook = $this->input->post('facebook');
        $tweet = $this->input->post('tweet_text');

        if (!$tweet || mb_strlen($tweet) > 140 || mb_strlen($tweet) < 1) {

            print 'Your tweet was either too big or too short...click "back" and fix it b';

        } else {

            $this->load->library('twitteroauth');
            $this->config->load('twitter');
            $connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->config->item('twitter_access_token'), $this->config->item('twitter_access_secret'));

            $result = $connection->post('statuses/update', array('status' => $tweet));

            if (!isset($result->errors) ) {

                if ($facebook) {

                    $id = $this->input->post('id');

                    redirect('facebook?id='.$id);

                } elseif ($facebook == false) {

                    $data['title'] = 'Compose Tweet ';
                    $data['success'] = 'Posted Successfully!';
                    $this->load->view('admin/tweet', $data);

                }

            } else {

                print 'You broke something...talk to Will';

            }

        }

    }

    public function facebook() {

        $this->Author_model->restricted();

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $data['post'] = $this->Post_model->get(array('post_id' => $id), '1', '0');
            $data['title'] = 'Facebook Post: ' . $data['post']->post_title;

            $this->load->view('admin/facebook', $data);

        } else {

            $data['title'] = 'Compose Facebook Post ';
            $this->load->view('admin/facebook', $data);

        }

    }


    public function post_facebook() {

        $post = $this->input->post('facebook_text');
        $url = $this->input->post('facebook_url');

        $this->load->library('facebook');
        $this->config->load('facebook');

        $facebook = new Facebook(array(
            'appId'  => $this->config->item('appId'),
            'secret' => $this->config->item('secret'),
            'cookie' => true
        ));

        $token = $facebook->getAccessToken();
        $user = $facebook->getUser();
        $channel599_id = '161447017220514';

        $page_token = $this->Post_model->fb_token($channel599_id, $token, $user);

        // var_dump($user);
        // var_dump($page_token);

        $attachment = array(
            'access_token' => $page_token,
            'message' => $post,
            'link' => $url,
        );

        $result = $facebook->api('/'.$channel599_id.'/feed/', 'post', $attachment);

        if ($result) {

            $data['title'] = 'Compose Facebook Post';
            $data['success'] = 'Posted Successfully!';
            $this->load->view('admin/facebook', $data);

        }

    }

    public function edit($id) {

        $this->Author_model->restricted();

        $data['genres'] = $this->Genre_model->all();
        $data['post'] = $this->Post_model->get(array('post_id' => $id), '1', '0');
        $data['title'] = 'Edit: ' . $data['post']->post_title;

        $this->load->view('admin/edit', $data);

    }

    public function update() {

        $id = $this->input->post('post_id');
        //$type = $this->input->post('post_type');
        $title = $this->input->post('post_title');
        $slug = url_title($title, 'dash', true);
        $url = $this->input->post('post_media');
        $status = $this->input->post('post_status');
        $text = $this->input->post('post_text');
        $genre_id = $this->input->post('post_genre');

        if (strpos($url, 'youtube') !== false) {
            
            $media = substr($url, strrpos($url, '?v=' ) + 3, 11);
            $img = 'http://img.youtube.com/vi/'.$media.'/hqdefault.jpg';
            $source = 'youtube';
        
        } elseif (strpos($url, 'soundcloud') !== false) { 

            $client = 'e9fc1d5a435447d40bb665d017a6cd9a';
            $escaped_url = mysql_real_escape_string($url);
            $json = file_get_contents('http://api.soundcloud.com/resolve.json?client_id='.$client.'&url='.$escaped_url);

            $media = json_decode($json)->permalink_url;

            if (json_decode($json)->artwork_url == null) {
                $img = substr(json_decode($json)->user->avatar_url, 0, -18).'-t500x500.jpg';
            } else {
                $img = substr(json_decode($json)->artwork_url, 0, -18).'-t500x500.jpg';
            }

            $source = 'soundcloud';

            var_dump($json);

        } else {

            print 'Unsupported';

        }

        $data = array(
            'post_title' => $title,
            'post_slug' => $slug,
            'post_media' => $media,
            'post_img' => $img,
            'post_text' => $text,
            'post_type' => 'song',
            'post_genre_id' => $genre_id,
            'post_source' => $source,
            'post_status' => $status,
            'post_updated' => date('Y-m-d H:i:s')
        );

        if ($this->Post_model->update($id, $data)) {

            $data['genres'] = $this->Genre_model->all();
            $data['post'] = $this->Post_model->get(array('post_id' => $id), '1', '0');
            $data['success'] = 'Updated Successfully!';
            $data['title'] = 'Edit: ' . $data['post']->post_title;

            $this->load->view('admin/edit', $data);

        }

    }

    public function update_genre() {

        $id = $this->input->post('post_id');
        $genre_id = $this->input->post('post_genre');

        $data = array(
            'post_genre_id' => $genre_id,
            'post_updated' => date('Y-m-d H:i:s')
        );

        if ($this->Post_model->update($id, $data)) {

            redirect('dashboard');

        }

    }

    public function delete($id) {

        if ($this->Post_model->delete($id)) {

            redirect('dashboard');

        }

    }

    public function errors($time) {

        if ($time == 'all') {

            $data['posts'] = $this->Post_model->get(array('post_source' => 'youtube'), '100000', '0');

        } else {

            $data['posts'] = $this->Post_model->get(array('post_source' => 'youtube', 'post_created >' => date('Y-m-d H:i:s', strtotime('-'.$time.' days'))), '100000', '0');

        }

        $key = 'AI39si7uMSVAh5_mFvEjOr-4a3zjcpGzP8H8AxfGFAJ-pGm9yWRuOsU_gCj9d0_QP-aB2HW6WxPt4MsUx5Nkuf3AxXDUtf_lFQ';

        foreach ($data['posts'] as $post) {

            $media = $post->post_media;

            if ($post->post_status != 'draft') {

                $this->Post_model->update($post->post_id, array( 'post_status' => 'published' )); // RESET EVERYTHING!

                $json = json_decode(file_get_contents('http://gdata.youtube.com/feeds/api/videos/'.$media.'?v=2&alt=jsonc&key='.$key));

                if (isset($json->data)) {

                    if (isset($json->data->restrictions[0]->countries)) {
             
                        if (strpos($json->data->restrictions[0]->countries,'US') !== false) {

                            $this->Post_model->update($post->post_id, array( 'post_status' => 'error' ));

                            print '<p style="margin-bottom:20px;">' . $post->post_title . '</p>';
                     
                        }

                    }

                } else {

                    $this->Post_model->update($post->post_id, array( 'post_status' => 'error' ));

                    print '<p style="margin-bottom:20px;">' . $post->post_title . '</p>';

                }

                sleep(1);

            }

        }

    }

    public function soundcloud() {

        $this->Author_model->restricted();

        $data['title'] = 'Soundcloud Ripper';

        $this->load->view('admin/soundcloud', $data);

    }

    public function download() {

        $this->Author_model->restricted();

        $data['title'] = 'Soundcloud Ripper';

        $data['id'] = 'e0ac220c7f34ae5602f816d9b51e12e3';

        $url = $this->input->post('soundcloud_url');

        $json = json_decode(file_get_contents('http://api.soundcloud.com/resolve.json?url='.$url.'&client_id='.$data['id']));

        if ($json->artwork_url == null) {
            $img = substr($json->user->avatar_url, 0, -18).'-t500x500.jpg';
        } else {
            $img = substr($json->artwork_url, 0, -18).'-t500x500.jpg';
        }

        $data['img'] = $img;
        $data['source'] = $url;
        $data['url'] = $json->stream_url;
        $data['slug'] = $json->permalink;

        $this->load->view('admin/download', $data);

    }


}