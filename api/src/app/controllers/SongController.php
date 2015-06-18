<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SongController extends CI_Controller {

    public function index () {
        
        $match = array('songs.id >' => 0);

        if (isset($_GET['user_id'])) {
            $match['user_id'] = $_GET['user_id'];
        }

        if (isset($_GET['status_id'])) {
            $match['status_id'] = $_GET['status_id'];
        }

        $results = $this->CRUD->read('songs', $match); 

        echo json_encode($results);
    }

    public function create () {

        $input = json_decode(trim(file_get_contents('php://input')), true);

        $newPost = array(
            'title' => $input['title'],
            'slug' => url_title($input['title'], 'dash', true),
            'image_url' => $input['image_url'],
            'text' => $input['text'],
            'source' => $input['source'],
            'source_url' => $input['source_url'],
            'source_id' => $input['source_id'],
            'user_id' => 2, //$this->session->userdata('user_id'),
            'genre_id' => $input['genre_id'],
            'status_id' => $input['status_id']
        );

        $created = $this->CRUD->create('songs', $newPost);
        $created['annotations'] = array();

        foreach ($input['annotations'] as $annotation) {
            if (isset($annotation['time']) && isset($annotation['timestamp']) && isset($annotation['text'])) {
                
                $newAnnotation = array(
                    'song_id' => $created['id'],
                    'time' => $annotation['time'],
                    'timestamp' => $annotation['timestamp'],
                    'text' => $annotation['text']
                );

                $createdAnnotation = $this->CRUD->create('annotations', $newAnnotation);

                array_push($created['annotations'], $createdAnnotation);

            }
        }

        echo json_encode($created);
    
    }

    public function update ($id) {

        $input = json_decode(trim(file_get_contents('php://input')), true);

        $match = array('id' => $id);

        $post = array(
            'title' => $input['title'],
            'slug' => url_title($input['title'], 'dash', true),
            'image_url' => $input['image_url'],
            'text' => $input['text'],
            'source' => $input['source'],
            'source_url' => $input['source_url'],
            'source_id' => $input['source_id'],
            'user_id' => $this->session->userdata('user_id'),
            'genre_id' => $input['genre_id'],
            'status_id' => 1
        );

        $updated = $this->CRUD->update('songs', $match, $post);
        echo json_encode($updated);
    
    }

}
