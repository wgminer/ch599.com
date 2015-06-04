<?php

class CRUD extends CI_Model {

    public function create($db, $table, $data) {

        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        if (!isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        $db->insert($table, $data);

        if ($db->affected_rows() > 0) {
            $data['id'] = $db->insert_id();
            return $data;
        } else {
            return false;
        }
    } 

    public function read($db, $table, $match) {

        $db->where($match);

        if ($table == 'songs') {
            $db->join('users', 'users.id = songs.user_id ');
            $db->join('genres', 'genres.id = songs.genre_id ');
            $db->select('songs.*');
            $db->select('users.name as user_name, users.slug as user_slug');
            $db->select('genres.name as genre_name, genres.slug as genre_slug');
            $db->order_by('songs.created_at', 'DESC');
        }

        if ($table == 'users') {
            $db->select('id, name, slug, email, bio, photo, created_at, updated_at');
        }

        $query = $db->get($table);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }

    }

    public function update($db, $table, $match, $data) {

        $data['updated_at'] = date('Y-m-d H:i:s');

        $db->where($match);
        $db->update($table, $data);

        if ($db->affected_rows() > 0) {
            return true;
        }
    } 

    public function delete($db, $table, $match) {

        $db->where($match);
        $db->delete($table); 

        if ($db->affected_rows() > 0) {

            return true;
        
        }

    }

}