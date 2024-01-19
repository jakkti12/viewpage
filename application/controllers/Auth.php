<?php
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('auth_model');
    }
    
    public function index()
    {
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('content');
        $this->load->view('footer');
    }
    
    public function login()
    {
        if($this->session->userdata('email')){
            redirect('');
        }
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $this->form_validation->set_rules('email' ,'Email' ,'required|valid_email');
        $this->form_validation->set_rules('password' , 'Password' , 'required|min_length[3]');
        
        if($this->form_validation->run()){
            $check_login = $this->auth_model->login($email , $password);
            
            if($check_login){
                foreach($check_login as $email => $val){
                    $this->session->set_userdata($email , $val);
                }
                redirect('');
            }else{
                echo 'login falil';
            }
        }
        $this->load->view('login');
    }
    
    public function logout()
    {
        $this->auth_model->logout();
        redirect('');
    }
}