<?php

class Genre_model extends CI_Model {

    public function get($array) {

        $this->db->where($array);
        
        $query = $this->db->get('genres');

        if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;

        } else {

            $row = $query->row();

            return $row;

        }
        
    }

    public function getActive() {

        $genres = $this->Post_model->distinct('post_genre_id');

        if (count($genres) > 1) {

            foreach ($genres as $genre) {
                
                if ($genre->post_genre_id != '0') {

                    $this->db->where('genre_id', $genre->post_genre_id);
                    $this->db->order_by('genre_name', 'ASC');

                    $query = $this->db->get('genres');

                    $data[] = $query->row();

                }

            }

            return $data;

        } else {

            $this->db->where('genre_id', $genres->post_genre_id);
            $this->db->order_by('genre_name', 'ASC');
            
            $query = $this->db->get('genres');

            $row = $query->row();

            return $row;

        }

    }

    public function all() {

        $this->db->order_by('genre_name', 'ASC');
        $query = $this->db->get('genres');

        if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {
                $data[] = $row;
            }

            return $data;

        } else {

            $row = $query->row();

            return $row;

        }

    }

}

?>