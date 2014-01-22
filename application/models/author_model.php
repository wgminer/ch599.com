<?php

class Author_model extends CI_Model {

    public function get($array) {

        $this->db->where($array);

        $query = $this->db->get('authors');

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

        $authors = $this->Post_model->distinct('post_author_id');

        if (count($authors) > 1) {

            foreach ($authors as $author) {
                
                $this->db->where('author_id', $author->post_author_id);
                $this->db->order_by('author_name', 'ASC');

                $query = $this->db->get('authors');

                $data[] = $query->row();

            }

            return $data;

        } else {

            $this->db->where('author_id', $authors->post_author_id);
            $this->db->order_by('author_name', 'ASC');

            $query = $this->db->get('authors');

            $row = $query->row();

            return $row;

        }

    }

    public function create($data) {

        $this->db->insert('authors', $data);

        if ($this->db->affected_rows() > 0) {

            return true;

        }
    } 

    public function update($id, $data) {

        $this->db->where('author_id', $id);

        $this->db->update('authors', $data);

        if ($this->db->affected_rows() > 0) {

            return true;
        
        }
    } 

    public function login($name, $password) {

        $this->db->where('author_name', $name);

        $this->db->where('author_password', $password);

        $query = $this->db->get('authors');

        if($query->num_rows() == 1) {

            $row = $query->row();

            $cookie = array(
                'author_id' => $row->author_id,
                'author_name' => $row->author_name,
                'logged_in' => true
            );

            $this->session->set_userdata($cookie);

            return true;

        } else {

            return false;

        }

    }

    public function restricted() {

        if ($this->session->userdata('logged_in')) {

            return true;

        } else {

            show_404();

        }

    }

}

?>