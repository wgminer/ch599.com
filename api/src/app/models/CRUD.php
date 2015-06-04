<?php

class CRUD extends CI_Model {

    public function create($table, $data) {

        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        if (!isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->insert($table, $data);

        if ($this->db->affected_rows() > 0) {
            $data['id'] = $this->db->insert_id();
            return $data;
        } else {
            return false;
        }
    } 

    public function read($table, $match) {

        $this->db->where($match);

        if ($table == 'songs') {
            $this->db->join('users', 'users.id = songs.user_id ');
            // $this->db->join('genres', 'genres.id = songs.genre_id ');
            $this->db->select('songs.*');
            $this->db->select('users.name as user_name, users.slug as user_slug');
            // $this->db->select('genres.name as genre_name, genres.slug as genre_slug');
            $this->db->order_by('songs.created_at', 'DESC');
        }

        if ($table == 'users') {
            $this->db->select('id, name, slug, email, bio, photo, created_at, updated_at');
        }

        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function update($table, $match, $data) {

        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where($match);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        }
    } 

    public function delete($table, $match) {

        $this->db->where($match);
        $this->db->delete($table); 

        if ($this->db->affected_rows() > 0) {

            return true;
        
        }

    }

}