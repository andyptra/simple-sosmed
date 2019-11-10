<?php defined('BASEPATH') or exit('No direct script access allowed');

class Post_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function getTimeline($param)
    {
        $this->db->select("posts.*,photo,full_name,genres.name_genre");
        $this->db->from("posts");
        $this->db->join('follows', 'follows.is_following = posts.user_id');
        $this->db->join('users', 'users.id=follows.is_following');
        $this->db->join('genres','genres.id=users.genres_id');
        $this->db->where('follows.user_id', $param);
        $query1 = $this->db->get_compiled_select();
        $this->db->select("posts.*,photo,full_name,genres.name_genre");
        $this->db->from("posts");
        $this->db->join('users', 'users.id=posts.user_id');
        $this->db->join('genres','genres.id=users.genres_id');
        $this->db->where('posts.user_id', $param);
        $query2 = $this->db->get_compiled_select();
        $query = $this->db->query($query1 . " UNION " . $query2 . " order by date DESC ");
        return $query->result();
    }
    function getOwnTimeline($param, $username)
    {
        $this->db->select("posts.*,photo,full_name");
        $this->db->from("posts");
        $this->db->join('users', 'users.id=posts.user_id');
        $this->db->where('posts.user_id', $param);
        $this->db->where('users.username', $username);

        $this->db->order_by('date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function insertPost($data = array())
    {
        $insert =  $this->db->insert('posts', $data);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
}
