<?php

class Post_model extends CI_Model {

	public function create($data) {

        $this->db->insert('posts', $data);

        if ($this->db->affected_rows() > 0) {

            return $this->db->insert_id();

        } else {

        	return false;
        
        }
    } 

    public function update($id, $data) {

        $this->db->where('post_id', $id);

        $this->db->update('posts', $data);

        if ($this->db->affected_rows() > 0) {

            return true;
        
        }
    } 

    public function get($array, $limit, $offset) {

    	$this->db->where($array);
        $this->db->limit($limit, $offset);
        $this->db->order_by('post_created', 'DESC');
    	$query = $this->db->get('posts');

    	if ($query->num_rows() == 1) {

            $row = $query->row();

            return $row;
        
        } else if ($query->num_rows() > 1) {

        	foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;

        }

    }

    public function mini_url() {
    	
    	$length = 5;
		$charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

		do {
			$url = substr(str_shuffle(str_repeat($charset, $length)), 0, $length);
			$this->db->where('post_mini_url', $url);
			$query = $this->db->get('posts');
		}

		while($query->num_rows() > 0);

		return $url;

	}

}

?>