<?php

class Social_model extends CI_Model {

	public function hash() {
    	$length = 5;
		$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		do {
			$url = substr(str_shuffle(str_repeat($charset, $length)), 0, $length);
			$this->db->where('hash', $url);
			$query = $this->db->get('songs');
		}
		while($query->num_rows() > 0);
		return $url;
	}

    public function tweet($message) {

        $this->load->library('twitteroauth');
        $this->config->load('twitter');

        $connection = $this->twitteroauth->create(
            $this->config->item('twitter_consumer_token'), 
            $this->config->item('twitter_consumer_secret'), 
            $this->config->item('twitter_access_token'), 
            $this->config->item('twitter_access_secret')
        );

        return $connection->post('statuses/update', array('status' => $message));

    }
}


	
