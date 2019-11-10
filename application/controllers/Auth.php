<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect(base_url('dashboard'));
            exit;
        }
        $data['genre'] = $this->User_model->getGenre();

        $this->load->view('v_auth', $data);
    }

    public function login()
    {
        if (count($_POST)) {
            $this->load->helper('security');
            $this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('notif_login', 'please completed this form');
                redirect(base_url());
            } else {
                $email                  = $this->input->post('email');
                $password               = $this->input->post('password');
                $data = array(
                    'email' => $email,
                    'password' => $this->hash('sha1', $this->input->post('password'), AUTH_SALT),
                );

                $this->User_model->Authentification($data);
            }
        }
        if ($this->session->userdata('logged_in')) {
            redirect(base_url('dashboard'));
            exit;
        }
        $this->load->view('v_auth');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|min_length[5]|max_length[20]|required');
        $this->form_validation->set_rules('email', 'email', 'trim|valid_email|required');
        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('notif_register', 'please completed this form');
            redirect(base_url());
        } else {
            $username               = $this->input->post('username');
            $first                  = $this->input->post('first');
            $last                   = $this->input->post('last');
            $fullname               = $first . ' ' . $last;
            $email                  = $this->input->post('email');
            $password               = $this->input->post('password');
            $genres                 = $this->input->post('genres');
            $gender                 = $this->input->post('gender');
            $photo_url              = $this->input->post('photo_url');
            $date                   = date("Y-m-d h:i:s");
            $checkemail             = $this->User_model->user_email_count($email);
            $checkusername          = $this->User_model->user_username_count($username);
            if ($checkemail > 0) {
                $this->session->set_flashdata('notif_register', 'email already used');
                redirect(base_url());
            } elseif ($checkusername > 0) {
                $this->session->set_flashdata('notif_register', 'username already used');
                redirect(base_url());
            } else {
                $data = array(
                    'username' => $username,
                    'full_name' => $fullname,
                    'email' => $email,
                    'password' => $this->hash('sha1', $this->input->post('password'), AUTH_SALT),
                    'genres_id' => $genres,
                    'gender' => $gender,
                    'register_since' => $date,
                );
                $this->load->library('upload', [
                    'upload_path'    => FCPATH . 'public/uploads/',
                    'allowed_types'    => 'gif|jpg|png|pdf',
                    'max_size'        => 20048,
                    'encrypt_name'    => TRUE
                ]);
                $register = $this->User_model->register($data);
                if ($register) {
                    if ($photo_url) {
                        $data = array(
                            'photo' => $photo_url
                        );
                        $this->User_model->update($register, $data);
                        $this->session->set_flashdata('notif_register', 'success register');
                        redirect(base_url());
                    } else {
                        $upload = $this->do_upload($register, 'photo');
                        $getupload = $this->upload->data($upload);
                        $this->session->set_flashdata('notif_register', 'success register');
                        redirect(base_url());
                    }
                }
                $this->session->set_flashdata('notif_register', 'success register');
                redirect(base_url());
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect(base_url());
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
    protected function hash($algo, $data, $salt)
    {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }
}
