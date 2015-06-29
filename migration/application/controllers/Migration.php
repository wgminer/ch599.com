<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CI_Controller {

    public function index()
    {

    	$new = array(
    		'dsn'	=> '',
    		'hostname' => 'localhost',
    		'username' => 'root',
    		'password' => 'root',
    		'database' => 'channel599',
    		'dbdriver' => 'mysqli',
    		'dbprefix' => '',
    		'pconnect' => false,
    		'db_debug' => true,
    		'cache_on' => false,
    		'cachedir' => '',
    		'char_set' => 'utf8',
    		'dbcollat' => 'utf8_general_ci',
    		'swap_pre' => '',
    		'encrypt' => false,
    		'compress' => false,
    		'stricton' => false,
    		'failover' => array(),
    		'save_queries' => true
    	);

    	$old = array(
			'dsn'	=> '',
			'hostname' => 'localhost',
			'username' => 'root',
			'password' => 'root',
			'database' => 'old599',
			'dbdriver' => 'mysqli',
			'dbprefix' => '',
			'pconnect' => false,
			'db_debug' => true,
			'cache_on' => false,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => false,
			'compress' => false,
			'stricton' => false,
			'failover' => array(),
			'save_queries' => true
		);

		$old599 = $this->load->database($old, true);
		$new599 = $this->load->database($new, true);

        $new599->truncate('songs'); 
        $new599->truncate('users'); 
        $new599->truncate('genres'); 

        $posts = $this->CRUD->read($old599, 'posts', array('post_id >' => 0)); 
        $authors = $this->CRUD->read($old599, 'authors', array('author_id >' => 0)); 
        $oldGenres = $this->CRUD->read($old599, 'genres', array('genre_id >' => 0)); 

        $songs = array();
        $users = array();
        $genres = array();

        foreach ($posts as $post) {

            if ($post->post_status == 'published') {
                $status_id = 1;
            } 

            if ($post->post_status == 'draft') {
                $status_id = 2;
            } 

            if ($post->post_status == 'error') {
                $status_id = 3;
            } 

            if ($post->post_genre_id) {
                $genre_id = $post->post_genre_id;
            } else {
                $genre_id = 0;
            }

            $song = array(
                'id' => $post->post_id,
                'title' => $post->post_title,
                'slug' => $post->post_slug, 
                'hash' => $post->post_mini_url,
                'status_id' => $status_id,
                'image_url' => $post->post_img, 
                'text' => $post->post_text, 
                'source' => $post->post_source,
                'source_url' => 'http://www.youtube.com/watch?v=' . $post->post_media, 
                'source_id' => $post->post_media, 
                'user_id' => $post->post_author_id,
                'genre_id' => $genre_id, 
                'created_at' => $post->post_created,
                'updated_at' => $post->post_updated
            );

            array_push($songs, $song);

        }

        foreach ($authors as $author) {

            $user = array(
                'id' => $author->author_id,
                'name' => $author->author_name,
                'slug' => $author->author_slug,
                'email' => $author->author_email,
                'password' => $author->author_password,
                'photo' => $author->author_photo,
                'bio' => $author->author_bio,
                'created_at' => $author->author_created,
                'updated_at' => $author->author_created
            );

            array_push($users, $user);

        }

        foreach ($oldGenres as $oldGenre) {

            $genre = array(
                'id' => $oldGenre->genre_id,
                'name' => $oldGenre->genre_name,
                'slug' => $oldGenre->genre_slug, 
            );

            array_push($genres, $genre);

        }

        $new599->insert_batch('songs', $songs);
        $new599->insert_batch('users', $users);
        $new599->insert_batch('genres', $genres);

        echo 'done!';

    }

}
