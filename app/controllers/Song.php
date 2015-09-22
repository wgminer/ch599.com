<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Song extends CI_Controller {

    public function segmentTitle ($title) 
    {
        $dashPos = strrpos($title, ' - ');
        
        if ($dashPos) {
            $artist = substr($title, 0,  $dashPos);
            $name = substr($title, $dashPos + 3, strlen($title));
            return '<a href="" class="song__title__artist">' . $artist . '</a><span class="song__title__name">' . $name . '</span>'; 
        } else {
            return '<span class="song__title__name">' . $title . '</span>';
        }
    }  

    public function parseTwitter ($text) 
    {

        /*
        var output,
            text    = "@RayFranco is answering to @AnPel, this is a real '@username83' but this is an@email.com, and this is a @probablyfaketwitterusername",
            regex   = /(^|[^@\w])@(\w{1,15})\b/g,
            replace = '$1<a href="http://twitter.com/$2">@$2</a>';

        */

        $replaced = preg_replace_callback(
            '/@(\w{1,15})\b/', 
            function ($matches) {    
                // var_dump($matches);
                return '<a href="http://twitter.com/' . $matches[1] . '">' . $matches[0] . '</a>';
            }, 
            $text
        );
        return $replaced;
    }

    public function index () {
        
        $match = array('songs.id >' => 0);
        $limit = false;
        $offset = 0;

        if (isset($_GET['user_id'])) {
            $match['user_id'] = $_GET['user_id'];
        }

        if (isset($_GET['user_slug'])) {
            $match['users.slug'] = $_GET['user_slug'];
        }

        if (isset($_GET['genre_id'])) {
            $match['genre_id'] = $_GET['genre_id'];
        }

        if (isset($_GET['genre_slug'])) {
            $match['genres.slug'] = $_GET['genre_slug'];
        }

        if (isset($_GET['slug'])) {
            $match['songs.slug'] = $_GET['slug'];
        }

        if (isset($_GET['status_id'])) {
            $match['status_id'] = $_GET['status_id'];
        }

        if (isset($_GET['limit'])) {
            $limit = $_GET['limit'];
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }

        $results = $this->CRUD->read('songs', $match, $limit, $offset); 

        if ($results != false) {

            if (isset($_GET['formatted'])) {
                foreach ($results as $song) {
                    // $song->title = $this->segmentTitle($song->title);
                    $song->text = $this->parseTwitter($song->text);
                }
            }

            echo json_encode($results);
        } else {
            echo json_encode([]);
        }
        
    }

    public function create () {

        $input = json_decode(trim(file_get_contents('php://input')), true);

        $newPost = array(
            'title' => $input['title'],
            'slug' => url_title($input['title'], 'dash', true),
            'image_url' => $input['image_url'],
            'text' => $input['text'],
            'highlighted' => $input['highlighted'],
            'source' => $input['source'],
            'source_url' => $input['source_url'],
            'source_id' => $input['source_id'],
            'user_id' => 2, //$this->session->userdata('user_id'),
            'genre_id' => $input['genre_id'],
            'status_id' => $input['status_id']
        );

        $created = $this->CRUD->create('songs', $newPost);

        echo json_encode($created);
    
    }

    public function update ($id) {

        $input = json_decode(trim(file_get_contents('php://input')), true);

        $match = array('id' => $id);

        $post = array(
            'id' => $id,
            'title' => $input['title'],
            'slug' => url_title($input['title'], 'dash', true),
            'image_url' => $input['image_url'],
            'text' => $input['text'],
            'highlighted' => $input['highlighted'],
            'source' => $input['source'],
            'source_url' => $input['source_url'],
            'source_id' => $input['source_id'],
            'user_id' => 2, //$this->session->userdata('user_id'),
            'genre_id' => $input['genre_id'],
            'status_id' => $input['status_id']
        );

        $updated = $this->CRUD->update('songs', $match, $post);
        echo json_encode($updated);
    
    }

    public function delete ($id) {
        $match = array('id' => $id);
        $deleted = $this->CRUD->delete('songs', $match);
        echo json_encode($deleted);
    }

}
