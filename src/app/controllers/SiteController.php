<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteController extends CI_Controller {

    public function segmentTitle ($title) 
    {
        $pos = strrpos($title, ' - ');
        
        if ($pos) {
            $artist = substr($title, 0,  $pos);
            $name = substr($title, $pos + 3, strlen($title));
            return '<span class="song__title--artist">' . $artist . '</span><span class="song__title--seperator"> - </span><span class="song__title--name">' . $name . '</span>'; 
        } else {
            return '<span class="song__title--name">' . $title . '</span>';
        }
    }  

    public function addAnnotations ($string, $source_id) 
    {        
        $replaced = preg_replace_callback(
            '/\[(.*)]/U', function ($matches) use ($source_id) {
                $seconds = substr($matches[1], -2, 2);
                $minutes = substr($matches[1], -5, 2);
                $hours = substr($matches[1], 0, strlen($matches[1]) - 6);

                $seconds = intval($seconds);
                $minutes = intval($minutes);
                $hours = intval($hours);

                if (!is_numeric($seconds)) {
                    $seconds = 0;
                }

                if (!is_numeric($minutes) || strlen($matches[1]) < 3) {
                    $minutes = 0;
                }

                if (!is_numeric($hours) || strlen($matches[1]) < 6) {
                    $hours = 0;
                }

                $timestamp = ($hours * 60 * 60 * 1000) + ($minutes * 60 * 1000) + ($seconds * 1000);
                
                return '<span class="song__annotation" data-source-id="' . $source_id . '" data-timestamp="' . $timestamp . '">' . $matches[1] . '</span>';
            }, 
            $string
        );
        return $replaced;
    }   

    public function index()
    {
        $match = array(
            'songs.id > ' => 0,
        );

        $data['songs'] = $this->CRUD->read('songs', $match);

        foreach ($data['songs'] as $song) {
            $song->title = $this->segmentTitle($song->title);
        }

        foreach ($data['songs'] as $song) {
            $song->text = $this->addAnnotations($song->text, $song->source_id);
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
