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

            $author = $this->Author_model->get(array('author_id' => $row->post_author_id));
            $row->post_author = $author->author_name;
            $row->post_author_slug = $author->author_slug;

            if ($row->post_genre_id != 0) {
                $genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id));
                $row->post_genre = $genre->genre_name;
                $row->post_genre_slug = $genre->genre_slug;
            }

            return $row;
        
        } else if ($query->num_rows() > 1) {

        	foreach ($query->result() as $row) {

                $author = $this->Author_model->get(array('author_id' => $row->post_author_id));
                $row->post_author = $author->author_name;
                $row->post_author_slug = $author->author_slug;

                if ($row->post_genre_id != 0) {
                    $genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id));
                    $row->post_genre = $genre->genre_name;
                    $row->post_genre_slug = $genre->genre_slug;
                }

                $data[] = $row;
            }

            return $data;

        } else {

            return false;

        }

    }

    public function delete($id) {

        $this->db->where('post_id', $id);
        $this->db->delete('posts'); 

        if ($this->db->affected_rows() > 0) {

            return true;
        
        }

    }

    public function playlist($posts) {

        if (count($posts) > 1) {

            foreach ($posts as $post) {

                if (strlen($post) == 5) {
                    
                    $this->db->where('post_mini_url', $post);
                    $this->db->where('post_status', 'published');
                    $this->db->where('post_source', 'youtube');

                    $query = $this->db->get('posts');

                    $row = $query->row();

                    $author = $this->Author_model->get(array('author_id' => $row->post_author_id));
                    $row->post_author = $author->author_name;
                    $row->post_author_slug = $author->author_slug;

                    if ($row->post_genre_id != 0) {
                        $genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id));
                        $row->post_genre = $genre->genre_name;
                        $row->post_genre_slug = $genre->genre_slug;
                    }

                    $data[] = $row;

                }

            }

            return $data;

        } else {

            if (strlen($post) == 5) {
                    
                $this->db->where('post_mini_url', $post);
                $this->db->where('post_status', 'published');
                $this->db->where('post_source', 'youtube');

                $query = $this->db->get('posts');

                $row = $query->row();

                $author = $this->Author_model->get(array('author_id' => $row->post_author_id));
                $row->post_author = $author->author_name;
                $row->post_author_slug = $author->author_slug;

                if ($row->post_genre_id != 0) {
                    $genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id));
                    $row->post_genre = $genre->genre_name;
                    $row->post_genre_slug = $genre->genre_slug;
                }

                return $row;

            } else {

                return false;

            }

        }
    }


    public function search($term) {

        $this->db->where('post_status', 'published');
        $this->db->where('post_source', 'youtube');
        $this->db->like('post_title', $term);        
        $this->db->order_by('post_created', 'DESC');
        
        $query = $this->db->get('posts');

        if ($query->num_rows() == 1) {

            $row = $query->row();

            $author = $this->Author_model->get(array('author_id' => $row->post_author_id));
            $row->post_author = $author->author_name;
            $row->post_author_slug = $author->author_slug;

            if ($row->post_genre_id != 0) {
                $genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id));
                $row->post_genre = $genre->genre_name;
                $row->post_genre_slug = $genre->genre_slug;
            }

            return $row;
        
        } else if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {

                $author = $this->Author_model->get(array('author_id' => $row->post_author_id));
                $row->post_author = $author->author_name;
                $row->post_author_slug = $author->author_slug;

                if ($row->post_genre_id != 0) {
                    $genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id));
                    $row->post_genre = $genre->genre_name;
                    $row->post_genre_slug = $genre->genre_slug;
                }
                
                $data[] = $row;
            }

            return $data;

        } 

    }

    public function random($limit) {

        $this->db->where('post_status', 'published');
        $this->db->where('post_source', 'youtube');
        $this->db->order_by('post_id', 'RANDOM');
        $this->db->limit($limit, '0');

        $query = $this->db->get('posts');

        if ($query->num_rows() == 1) {

            $row = $query->row();

            $row->post_author = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_name;
            $row->post_author_slug = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_slug;

            if ($row->post_genre_id != 0) {
                $row->post_genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_name;
                $row->post_genre_slug = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_slug;
            }

            return $row;
        
        } else if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {

                $row->post_author = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_name;
                $row->post_author_slug = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_slug;

                if ($row->post_genre_id != 0) {
                    $row->post_genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_name;
                    $row->post_genre_slug = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_slug;
                }

                $data[] = $row;
            }

            return $data;

        } 
        
    }

    public function good($limit) {

        $good = array('2', '3', '4', '6', '10', '11');

        $this->db->where('post_status', 'published');
        $this->db->where('post_source', 'youtube');
        $this->db->where_in('post_author_id', $good);
        $this->db->order_by('post_id', 'RANDOM');
        $this->db->limit($limit, '0');

        $query = $this->db->get('posts');

        if ($query->num_rows() == 1) {

            $row = $query->row();

            $row->post_author = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_name;
            $row->post_author_slug = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_slug;

            if ($row->post_genre_id != 0) {
                $row->post_genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_name;
                $row->post_genre_slug = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_slug;
            }

            return $row;
        
        } else if ($query->num_rows() > 1) {

            foreach ($query->result() as $row) {

                $row->post_author = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_name;
                $row->post_author_slug = $this->Author_model->get(array('author_id' => $row->post_author_id))->author_slug;

                if ($row->post_genre_id != 0) {
                    $row->post_genre = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_name;
                    $row->post_genre_slug = $this->Genre_model->get(array('genre_id' => $row->post_genre_id))->genre_slug;
                }

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

    public function distinct($column) {

        $this->db->select($column);
        $this->db->distinct();
        $this->db->order_by($column, 'ASC');
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

    public function device() {

        if ($this->agent->is_mobile()) {

            return 'mobile';
        
        } else {

            return 'desktop';

        }

    }

    public function fb_token($page_id, $access_token, $user_id) {

        $data = file_get_contents('https://graph.beta.facebook.com/'.$user_id.'/accounts?access_token='.$access_token);
        $pages = json_decode($data, true);

        foreach($pages['data'] as $page) {

          if($page['id'] == $page_id) {

            return $page['access_token']; 

          }   

       }

    }

}

?>