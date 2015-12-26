<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function errors () {

        $ytApiKey = 'AIzaSyBbHFX8Vfs6JA3U0QVO55QqAkg7QMAm8_0';

        $match = array('songs.status_id' => 1);
        $results = $this->CRUD->read('songs', $match); 

        foreach ($results as $song) {

            // Only run on published YouTube songs
            if ($song->source == 'youtube') { 

                // if image 404's (ie. song deleted or account suspended)
                $image = @file_get_contents('https://i.ytimg.com/vi/' . $song->source_id . '/default.jpg');
                
                if (!$image) {
                    // var_dump($song->title);
                    // echo '<br><br><br><br>';
                    $this->CRUD->update('songs', array('songs.id' => $song->id), array('status_id' => 3));
                    continue;
                }

                // If licensed content takedown has occurred
                $contentDetails = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=' . $song->source_id . '&key=' . $ytApiKey));                
                if (isset($contentDetails->items[0]->contentDetails->regionRestriction->blocked)) {

                    if (in_array("US", $contentDetails->items[0]->contentDetails->regionRestriction->blocked)) {
                        // var_dump($song->title);
                        // echo '<br><br><br><br>';
                        $this->CRUD->update('songs', array('songs.id' => $song->id), array('status_id' => 3));
                    }
                }
            }

            sleep(1);
        }
  
    }

}
