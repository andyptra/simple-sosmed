<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{
    var $session_user;
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');
        $this->load->model('Post_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $slug        = $this->uri->segment(1);
        $type        = $this->uri->segment(2);
        $data['session_user'] = $this->session_user;
        $get_id =  $this->session_user['users_id'];
        $getTimeline = $this->Post_model->getOwnTimeline(getUseridByUsername($slug), $slug);
        $getOtherTimeline = $this->Post_model->getOwnTimeline(getUseridByUsername($slug), $slug);
        $following = getUserFollowers('followers', getUseridByUsername($slug));
        $followers = getUserFollowers('following', getUseridByUsername($slug));
        $data['username'] = $slug;
        $data['session_username'] = $this->session_user['username'];
        $data['followers'] = $followers;
        $data['following'] = $following;
        $data['otherUser'] = $this->User_model->getUserEdit($slug);
        $data['fullname'] = $this->session_user['fullname'];
        $data['photos'] = $this->session_user['photo'];
        $data['genre'] = $this->User_model->getGenre();
        $getnotfriend = $this->User_model->getIsFriend($get_id, getUseridByUsername($slug));
        $getIsNotFollow = $this->User_model->getIsNotFollow($get_id, getUseridByUsername($slug));
        $getIsnotFollowback = $this->User_model->getIsnotFollowback($get_id, getUseridByUsername($slug));
        if (count($getnotfriend) == 1) {
            $data['friend'] = 'Friend';
        } else if (count($getnotfriend) == 0 && $getIsnotFollowback == 1) {

            $data['friend'] = 'Follow Back';
        } else if ($getIsNotFollow == 0) {
            $data['friend'] = 'Follow';
        } else {
            $data['friend'] = 'Follow';
        }

        if ($this->User_model->getUser($slug)) {
            if ($type == 'followers') {
                $array1    =  $this->User_model->getUserFollowers(getUseridByUsername($slug));
                $array2 = $this->User_model->getIsFollowed(getUseridByUsername($slug));
                $final = array();
                foreach ($array1 as $key1 => $data1) {
                    foreach ($array2 as $key2 => $data2) {
                        if ($data1['is_following'] == $data2['is_following']) {
                            $final[] = $data1 + $data2;
                            $final[$key2]['type'] = '1';
                            unset($array1[$key1]);
                            unset($array2[$key2]);
                        }
                    }
                }
                if (!empty($array1)) {
                    foreach ($array1 as $value) {
                        $value['type'] = '0';
                        $final[] = $value;
                    }
                }
                if (!empty($array2)) {
                    foreach ($array2 as $value) {
                        $value['type'] = '0';
                        $final[] = $value;
                    }
                }
                $data['follower'] = $final;
                $this->load->view('header', $data);
                $this->load->view('users/sub_header', $data);
                $this->load->view('users/left_sidebar', $data);
                $this->load->view('followers', $data);
                $this->load->view('users/right_sidebar', $data);
                $this->load->view('footer');
            } elseif ($type == 'following') {
                $array1    =  $this->User_model->getUserFollowing(getUseridByUsername($slug));
                $array2 = $this->User_model->getIsFollowBack(getUseridByUsername($slug));
                $final = array();
                foreach ($array1 as $key1 => $data1) {
                    foreach ($array2 as $key2 => $data2) {
                        if ($data1['user_id'] == $data2['user_id']) {
                            $final[] = $data1 + $data2;
                            $final[$key2]['type'] = '1';
                            unset($array1[$key1]);
                            unset($array2[$key2]);
                        }
                    }
                }
                if (!empty($array1)) {
                    foreach ($array1 as $value) {
                        $value['type'] = '0';
                        $final[] = $value;
                    }
                }
                if (!empty($array2)) {
                    foreach ($array2 as $value) {
                        $value['type'] = '0';
                        $final[] = $value;
                    }
                }
                $data['followings'] = $final;
                $this->load->view('header', $data);
                $this->load->view('users/sub_header', $data);
                $this->load->view('users/left_sidebar', $data);
                $this->load->view('following', $data);
                $this->load->view('users/right_sidebar', $data);
                $this->load->view('footer');
            } else if ($type == 'edit') {

                if ($data['username'] != $data['session_username']) { } else {
                   
                        $dt_user=$this->User_model->getUserEdit($slug);
                        $data['edituser']= $dt_user;
                        $this->load->view('header', $data);
                        $this->load->view('users/sub_header', $data);
                        $this->load->view('users/left_sidebar', $data);
                        $this->load->view('edit_profil', $data);
                        $this->load->view('users/right_sidebar', $data);
                        $this->load->view('footer');
                }
            }
            else if($type=="action"){
                $task =  $this->input->post('submit');
           
                if($task=='submit_profil'){
                    $id      =$this->input->post('id');
                    $first      =$this->input->post('first');
                    $last       =$this->input->post('last');
                    $email       =$this->input->post('email');
                    $mobile       =$this->input->post('mobile');
                    $gender       =$this->input->post('gender');
                    $address       =$this->input->post('address');
                    $age       =$this->input->post('age');
                    $genres       =$this->input->post('genres');
                    $bio       =$this->input->post('bio');
                    $fullname   = $first . ' ' . $last;
                    $data = array(
                        'full_name'=> $fullname,
                        'email'=> $email,
                        'mobile'=> $mobile,
                        'gender'=> $gender,
                        'address'=> $address,
                        'age'=> $age,
                        'genres_id'=> $genres,
                        'bio'=> $bio,
                    );
                    $this->db->where('id', $id);
                    $query=$this->db->update("users",$data);
                    if($query){
                        redirect(base_url($slug.'/edit'));
                    }else{
                        redirect(base_url($slug.'/edit'));
                    }
                }
                else if($task=='submit_password') {
                    $id      =$this->input->post('id');
                    $dt_user = $this->User_model->getUser($slug);
                    $old_password = $this->hash('sha1', $this->input->post('old_password'), AUTH_SALT);
                    $new_password = $this->hash('sha1', $this->input->post('new_password'), AUTH_SALT);
                    $confirm_password = $this->hash('sha1', $this->input->post('confirm_password'), AUTH_SALT);
                    if($dt_user->password==$old_password){
                        if($new_password==$confirm_password){
                            $data = array(
                                'password'=> $new_password
                            );
                            $this->db->where('id', $id);
                            $query=$this->db->update("users",$data);
                            redirect(base_url($slug.'/edit'));
                        }
                        else {
                            $this->session->set_flashdata('notif_password', 'password not same');
                            redirect(base_url($slug.'/edit'));
                        }
                    } else {
                        $this->session->set_flashdata('notif_password', 'old password incorrect');
                        redirect(base_url($slug.'/edit')); 
                    }

                }
                else if($task=='submit_photo') {
                   $id      =$this->input->post('id');
                   $this->do_upload($id, 'photo');
                   $this->do_upload($id, 'cover');
                    // redirect(base_url($slug.'/edit'));
                }
                else {
                    redirect(base_url($slug.'/edit'));
                }
            }
            else {
                $data['timeline'] = $getTimeline;
                $data['othertimeline'] = $getOtherTimeline;
                $this->load->view('header', $data);
                $this->load->view('users/sub_header', $data);
                $this->load->view('users/left_sidebar', $data);
                $this->load->view('owntimenline', $data);
                $this->load->view('users/right_sidebar', $data);
                $this->load->view('footer');
            }
        }
    }
    public function genre()
    {
      
        $slug                       = $this->uri->segment(1);
        $type                       = $this->uri->segment(2);
        
        $search                     = $this->input->get('search');
        $genre                      = $this->input->get('genre');
        if(!$search) $search='';
        if(!$genre) $genre=$type?:'';
        $data['session_user']       = $this->session_user;
        $get_id                     =  $this->session_user['users_id'];
        $getBySearch                = $this->User_model->getUserByGenre($get_id,$genre,$search);
        $getGenre                   = $this->User_model->getGenre();
        $data['getenre']            = $getGenre;
        $data['username']           = $slug;
        $data['getBySearch']        = $getBySearch;
        $data['session_username']   = $this->session_user['username'];
        $data['fullname']           = $this->session_user['fullname'];
        $data['photos']             = $this->session_user['photo'];
        
        $this->load->view('header', $data);
        $this->load->view('user_list', $data);
        $this->load->view('footer');
    }

    public function follow()
    {

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url());
        } else {
            $get_id =  $this->session_user['users_id'];
            $userName     = $this->uri->segment(2);
            $exec        = $this->User_model->userFollow($userName, $get_id);
            if ($exec == 'followed') {
                if (!empty($_SERVER['HTTP_REFERER'])) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(base_url());
                }
            } elseif ($exec == 'unfollowed') {
                if (!empty($_SERVER['HTTP_REFERER'])) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(base_url());
                }
            } else {
                if (!empty($_SERVER['HTTP_REFERER'])) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(base_url());
                }
            }
        }
    }

    public function insertPost()
    {
        $this->form_validation->set_rules('post', 'post', 'trim|required');
        print_r($_POST);
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('notif_error', 'please completed this form');
            $username      = $this->uri->segment(3);
            redirect(base_url($username));
        } else {
            $post               = $this->input->post('post');
            $id                 = $this->session_user['users_id'];
            $date                   = date("Y-m-d h:i:s");
            $data = array(
                'user_id'   => $id,
                'post'      => $post,
                'date'      => $date,
            );
            $this->Post_model->insertPost($data);
            redirect(base_url($username));
        }
    }
    protected function hash($algo, $data, $salt)
    {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }
    protected function do_upload($uid, $param)
    {
        $this->load->library('upload', [
            'upload_path'    => FCPATH . 'public/uploads/',
            'allowed_types'    => 'gif|jpg|png|pdf',
            'max_size'        => 20048,
            'encrypt_name'    => TRUE
        ]);
        if (!$this->upload->do_upload($param)) {
            throw new Exception($this->upload->display_errors('', ''), REST_Controller::HTTP_EXPECTATION_FAILED);
        } else {
            $data = $this->upload->data();
            $data = array($param => $data['file_name']);
            $this->User_model->update($uid, $data);
        }
    }
}
