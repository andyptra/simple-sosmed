<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function Authentification($data = array())
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			$row = $query->row();
			$sess_data = array(
				'users_id' => $row->id,
				'username' => $row->username,
				'fullname' => $row->full_name,
				'email' => $row->email,
				'photo' => $row->photo,
				'genres_id' => $row->genres_id
			);
			$this->session->set_userdata('logged_in', $sess_data);
			$this->update_last_login($row->id);
		} else {
			$this->session->set_flashdata('notif_login', 'password incorrect');
		}
		return true;
	}

	function register($data = array())
	{
		$this->db->insert('users', $data);
		$users_id = $this->db->insert_id();
		return $users_id;
	}
	function user_email_count($email)
	{
		$this->db->select('email');
		$this->db->from("users");
		$this->db->where('email', $email);
		return $this->db->count_all_results();
	}
	function user_username_count($email)
	{
		$this->db->select('username');
		$this->db->from("users");
		$this->db->where('username', $email);
		return $this->db->count_all_results();
	}
	function update($userId, $data = array())
	{
		if (!$data || !is_array($data)) return false;
		$this->db->where('id', $userId);
		return $this->db->update('users', $data);
	}
	function getUser($slug = null)
	{
		$query = $this->db->where('username', $slug)->limit(1)->get('users');
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}

	function getUserFollowers($user_id)
	{
		$this->db->select('user_id,is_following,username,full_name,photo');
		$this->db->from('follows');
		$this->db->join('users', 'users.id = follows.is_following');
		$this->db->where('follows.user_id', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getUserFollowing($user_id)
	{
		$this->db->select('user_id,is_following,username,full_name,photo');
		$this->db->from('follows');
		$this->db->join('users', 'users.id = follows.user_id');
		$this->db->where('follows.is_following', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getIsFollowed($user_id)
	{
		$this->db->select('follow1.id,follow1.user_id,follow1.is_following');
		$this->db->from('follows as follow1');
		$this->db->join('follows AS follow2 ', 'follow2.is_following = follow1.user_id');
		$this->db->where('follow1.user_id=follow2.is_following');
		$this->db->where('follow2.user_id=follow1.is_following');
		$this->db->where('follow1.user_id', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	function getIsFollowBack($user_id)
	{
		$this->db->select('follow1.id,follow1.user_id,follow1.is_following');
		$this->db->from('follows as follow1');
		$this->db->join('follows AS follow2 ', 'follow2.is_following = follow1.user_id');
		$this->db->where('follow1.user_id=follow2.is_following');
		$this->db->where('follow2.user_id=follow1.is_following');
		$this->db->where('follow1.is_following', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}


	function getIsFriend($user_id, $other_user_id)
	{
		$this->db->select('follow1.id');
		$this->db->from('follows as follow1');
		$this->db->join('follows AS follow2 ', 'follow2.is_following = follow1.user_id');
		$this->db->where('follow1.user_id=follow2.is_following');
		$this->db->where('follow2.user_id=follow1.is_following');
		$this->db->where('follow1.user_id', $user_id);
		$this->db->where('follow2.user_id', $other_user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}
	function getIsNotFollow($user_id, $other_user_id)
	{
		$this->db->select('follows.id');
		$this->db->from('follows');
		$this->db->where('follows.user_id', $user_id);
		$this->db->where('follows.is_following', $other_user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}
	function getIsnotFollowback($user_id, $other_user_id)
	{
		$this->db->select('follows.id');
		$this->db->from('follows');
		$this->db->where('follows.user_id', $other_user_id);
		$this->db->where('follows.is_following', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return 1;
		} else {
			return 0;
		}
	}
	function userFollow($username = null, $get_id)
	{
		$userID	= getUseridByUsername($username);
		$this->db->where(array('user_id' => $get_id, 'is_following' => $userID));
		$this->db->limit(1);
		$query = $this->db->get('follows');

		$this->db->where(array('user_id' => $userID, 'is_following' => $get_id));
		$this->db->limit(1);
		$query2 = $this->db->get('follows');

		if ($query2->num_rows() == 0) {
			if ($query->num_rows() >  0) {
				$data	= array(
					'user_id' 		=> $userID,
					'is_following'	=> $get_id,
					'date'			=>  date("Y-m-d h:i:s"),
				);
				if ($this->db->insert('follows', $data)) {
					return 'followed';
				} else {
					return false;
				}
			}
		} else if ($query2->num_rows() > 0) {
			if ($query->num_rows() > 0) {
				$this->db->where(array('user_id' => $get_id, 'is_following' => $userID))->limit(1);
				if ($this->db->limit(1)->delete('follows')) {
					return 'unfollowed';
				} else {
					return false;
				}
			}
		} else {
			$data	= array(
				'user_id' 		=> $get_id,
				'is_following'	=> $userID,
				'date'			=>  date("Y-m-d h:i:s"),
			);
			if ($this->db->insert('follows', $data)) {
				return 'followed';
			} else {
				return false;
			}
		}
	}

	function getGenre()
	{
		$this->db->from('genres');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}
	function getRecommended($user = null, $genre = null)
	{
		$this->db->select('users.id,user_id,is_following,username,full_name,photo');
		$this->db->from('users');
		$this->db->join('follows', 'follows.is_following = users.id');
		$this->db->join('genres', 'genres.id=users.genres_id');
		$this->db->where('users.genres_id', $genre);
		$this->db->where('users.id !=', $user);
		$this->db->limit('5');
		$this->db->order_by("rand()");
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
		
	}

	function getUserByGenre($user= null,$genre= null, $keyword = null){
		$this->db->select('users.id,username,full_name,photo,genres.id as idgenre, genres.name_genre');
		$this->db->from('users');
		if ($user) {
			$this->db->join('genres', 'genres.id=users.genres_id');
		}
		if ($keyword) {
			$this->db->like('users.full_name', $keyword);
		}
		if ($genre) {
			$this->db->where('users.id !=', $user);
			$this->db->where('users.genres_id', $genre);
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$dt=$query->result_array();
			$arrz= array();
			foreach($dt as $val){
				$arrz[] = array(
					'id'=>$val['id'],
					'username'=>$val['username'],
					'full_name'=>$val['full_name'],
					'photo'=>$val['photo'],
					'idgenre'=>$val['idgenre'],
					'name_genre'=>$val['name_genre'],
					'status'=> $this->getfriend($val['username'],$user),
				);
			}
			return $arrz;
		} else {
			return array();
		}
		
	}
	function getUserEdit($username){
		$userID	= getUseridByUsername($username);
		$this->db->select('users.*,genres.id as idgenres,genres.name_genre');
		$this->db->where('users.id',$userID);
		$this->db->join('genres','genres.id=users.genres_id');
		$this->db->limit(1);
		$query = $this->db->get('users');
		return $query->row();
	}
	private function getfriend($username,$get_id){
		$userID	= getUseridByUsername($username);
		$this->db->where(array('user_id' => $get_id, 'is_following' => $userID));
		$this->db->limit(1);
		$query = $this->db->get('follows');

		$this->db->where(array('user_id' => $userID, 'is_following' => $get_id));
		$this->db->limit(1);
		$query2 = $this->db->get('follows');

		if ($query2->num_rows() > 0) {
			if ($query->num_rows() >  0) {
				return 'friend';
			} else {
				return 'following';
			}
		} else {
			return 'follow';
		}

	}


	private function update_last_login($users_id)
	{
		$sql = "UPDATE users SET last_login = NOW() WHERE id=" . $this->db->escape($users_id);
		$this->db->query($sql);
	}
}
