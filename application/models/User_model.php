<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model 
{
    public function __construct() 
    {
        parent::__construct();
        $this->tableName = 'users';
        $this->orderBy = 'name';
        $this->timestamps = TRUE;
        $this->rules = array(
            'email'    => array(
                'field' => 'email', 
                'label' => 'Email', 
                'rules' => 'trim|required|valid_email'
            ),
            'password' => array(
                'field' => 'password', 
                'label' => 'Password', 
                'rules' => 'trim|required|min_length[6]'),
        );
        $this->_rulesAdmin = array(
            'name'    => array(
                'field' => 'name', 
                'label' => 'Name', 
                'rules' => 'trim|required'
            ),
            'email'    => array(
                'field' => 'email', 
                'label' => 'Email', 
                'rules' => 'trim|required|valid_email|callback__uniqueEmail'
            ),
            'password' => array(
                'field' => 'password', 
                'label' => 'Password', 
                'rules' => 'trim|min_length[6]|matches[password_confirm]'
            ),
            'password_confirm' => array(
                'field' => 'password_confirm', 
                'label' => 'Confirm password', 
                'rules' => 'trim|min_length[6]|matches[password]'
            ),
        );
    }
    
    public function getRules()
    {
        return $this->rules;
    }
    
    public function getRulesAdmin()
    {
        return $this->rulesAdmin;
    }

//    public function login()
//    {
//        $user = $this->getBy(array(
//            'email' => $this->input->post('email'),
//            'password' => $this->hash($this->input->post('password'))
//        ), TRUE)->row();
//                
//        if (count($user))
//        {
//            // Log in user
//            $data = array(
//                'name'     => $user->name,
//                'email'    => $user->email,
//                'id'       => $user->id,
//                'loggedin' => TRUE
//            );
//            $this->session->set_userdata($data);
//            
//            return TRUE;
//        }
//        
//        return FALSE;
//    }
    
    public function getNew()
    {
        $user = new stdClass();
        $user->name = '';
        $user->email = '';
        $user->passwod = '';
        
        return $user;
    }
}