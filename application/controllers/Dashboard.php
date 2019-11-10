<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
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
    /*
     * 
     */
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['session_user'] = $this->session_user;
        $get_id =  $this->session_user['users_id'];
        $genres =  $this->session_user['genres_id'];
        $getusername =  $this->session_user['username'];
        $following = getUserFollowers('following', getUseridByUsername($getusername));
        $getTimeline = $this->Post_model->getTimeline($get_id);
        $getRecommended = $this->User_model->getRecommended($get_id, $genres);
        $data['username'] = $this->session_user['username'];
        $data['photos'] = $this->session_user['photo'];
        $data['getRecommended'] = $getRecommended;
        $data['timeline'] = $getTimeline;
        $data['genre'] = $this->User_model->getGenre();
        $this->load->view('header', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('footer');
    }
    public function insertPost()
    {
        $this->form_validation->set_rules('post', 'post', 'trim|required');
        print_r($_POST);
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('notif_error', 'please completed this form');
            redirect('dashboard');
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
            redirect('dashboard');
        }
    }
}
