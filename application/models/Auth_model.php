<?php
class Auth_model extends CI_Model
{
    function login($email=null , $password=null)
    {
        if(empty($email) || empty($password)){
            return false;
        }else{
            $query = $this->db->query("SELECT * FROM users WHERE email = '$email'");
            $count = $query->num_rows();
            $check_login = $query->row();
            $item = $query->result();
            
            if($count == 1){
                foreach ($item as $row){
                    if($row->email == $email && $row->password == md5($password)){
                        return $check_login;
                    }
                }
            }
        }
        return false;
    }
    
    function logout()
    {
        $this->session->set_userdata(array('id' => '', 'firstname' => '', 'status' => ''));
        $this->session->sess_destroy();
    }
}