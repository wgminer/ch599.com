<?php

class User_model extends CI_Model {

    public function get($array) {

        if ( $array !== 'All') { // GET SPECIFIC USER

            $this->db->where($array);
            
            $query = $this->db->get('users');

            if ($query->num_rows() == 1) {

                $row = $query->row();

                return $row;

            }

        } else { // GET ALL USERS

            $query = $this->db->get('users');

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

    public function create($data) {

        $this->db->insert('users', $data);

        if ($this->db->affected_rows() > 0) {

            return true;

        }
    } 

    public function update($id, $data) {

        $this->db->where('user_id', $id);

        $this->db->update('users', $data);

        if ($this->db->affected_rows() > 0) {

            return true;
        
        }
    } 

    public function login($name, $password) {

        $this->db->where('user_name', $name);

        $this->db->where('user_password', $password);

        $query = $this->db->get('users');

        if($query->num_rows() == 1) {

            $row = $query->row();

            $cookie = array(
                'user_id' => $row->user_id,
                'user_name' => $row->user_name,
                'logged_in' => true
            );

            $this->session->set_userdata($cookie);

            return true;

        }

    }

    public function restricted() {

        if ($this->session->userdata('logged_in')) {

            return true;

        } else {

            redirect('login');

        }

    }

}

?>