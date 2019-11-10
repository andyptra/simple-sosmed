<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('getLink'))
{
	function getPost($string)
	{
        $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';   
        $stringx= preg_replace($url, '<a href="$0" style="color:#1abc9c">$0</a>', $string);
        $result = preg_replace('/(http|https):\/\/[^ ]+(\.gif|\.jpg|\.jpeg|\.png)/', '', $stringx);
        $newresult = str_replace('<a href="" style="color:#1abc9c">',"",$result);
        preg_match_all('/(http|https):\/\/[^ ]+(\.gif|\.jpg|\.jpeg|\.png)/',$string, $out);
        $dt_array = array (
            'post'=> $newresult,
            'img' => $out[0],
        );

        if(empty($dt_array)){
            $return = $string;
        }
        else {
            $return = $dt_array;
        }
        return $return;

    }
}

if(!function_exists('getUserFollowers'))
{
	function getUserFollowers($type = null, $userID = null, $loops = false)
	{
		$CI =& get_instance();
		$CI->db->select('*');
		if($type == 'followers')
		{
			$CI->db->where('is_following', $userID);
		}
		elseif($type == 'following')
		{
			$CI->db->where('user_id', $userID);
		}
		$query = $CI->db->get('follows');
		
        if ($query->num_rows() > 0)
		{
			if($loops)
			{
				return $query->result_array();
			}
			else
			{
				return $query->num_rows();
			}
		}
		else
		{
			if($loops)
			{
				return false;
			}
			else
			{
				return 0;
			}
		}
	}
}

if(!function_exists('getUseridByUsername'))
{
	function getUseridByUsername($username = '')
	{
		$CI =& get_instance();
        $CI->db->select('id');
		$CI->db->where('username', $username);
        $CI->db->limit(1);
        $query = $CI->db->get('users');
        if ($query->num_rows() > 0)
		{
            $results = $query->result_array();
        	foreach ($results as $u)
			{
				return $u['id'];
			}
		}
		else
		{
			return FALSE;
		}
	}
}