<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function oops () {
        $posts = $this->CRUD->read('posts', array('posts.post_id >' => 0));

        foreach ($posts as $post) {

            $song = $this->CRUD->read('songs', array('songs.hash' => $post->post_mini_url))[0];

            if ($song) {
                $this->CRUD->update('songs', array('songs.id' => $song->id), array('songs.user_id' => $post->post_author_id));
            }
        }
    }

    public function errors () {

        $ytApiKey = 'AIzaSyBbHFX8Vfs6JA3U0QVO55QqAkg7QMAm8_0';

        $match = array('songs.status_id' => 1);
        $all = $this->CRUD->read('songs', $match); 

        $limit = count($all) / 24; 
        $hours = date('H');
        $offset = $hours * $limit;

        if ($this->input->get('offset', true)) {
            $offset = $this->input->get('offset', true);
        }

        if ($this->input->get('limit', true)) {
            $limit = $this->input->get('limit', true);
        }

        $results = $this->CRUD->read('songs', $match, $limit, $offset);

        foreach ($results as $song) {

            // Only run on published YouTube songs
            if ($song->source == 'youtube') { 

                // if image 404's (ie. song deleted or account suspended)
                $image = @file_get_contents('https://i.ytimg.com/vi/' . $song->source_id . '/default.jpg');
                
                if (!$image) {
                    $this->CRUD->update('songs', array('songs.id' => $song->id), array('status_id' => 3));
                    if ($this->input->get('print', true)) {
                        echo 'Error: <a href="<?php echo base_url() ?><?php echo $song->slug; ?>">' . $song->title . '</a>';
                        echo '<br><br>';
                    }
                    continue;
                }

                // If licensed content takedown has occurred
                $contentDetails = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=' . $song->source_id . '&key=' . $ytApiKey));                
                if (isset($contentDetails->items[0]->contentDetails->regionRestriction->blocked)) {

                    if (in_array("US", $contentDetails->items[0]->contentDetails->regionRestriction->blocked)) {
                        $this->CRUD->update('songs', array('songs.id' => $song->id), array('status_id' => 3));
                        if ($this->input->get('print', true)) {
                            echo 'Error: <a href="<?php echo base_url() ?><?php echo $song->slug; ?>">' . $song->title . '</a>';
                            echo '<br><br>';
                        }
                    }
                }
            }

        }
  
    }

}
