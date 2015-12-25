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
}


	
