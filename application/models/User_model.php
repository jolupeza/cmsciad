<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends MY_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->_tableName = 'users';
        $this->_orderBy = 'name';
        $this->_rules = array(
          'email'    => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
          'password' => array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
        );
        $this->_rulesAdmin = array(
            'name'    => array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required'),
            'email'    => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|callback__uniqueEmail'),
            'password' => array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|matches[password_confirm]'),
            'password_confirm' => array('field' => 'password_confirm', 'label' => 'Confirm password', 'rules' => 'trim|matches[password]'),
        );
    }
    
    public function getRules()
    {
        return $this->_rules;
    }
    
    public function getRulesAdmin()
    {
        return $this->_rulesAdmin;
    }

    public function login()
    {
        $user = $this->getBy(array(
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password'))
        ), TRUE)->row();
                
        if (count($user))
        {
            // Log in user
            $data = array(
                'name'     => $user->name,
                'email'    => $user->email,
                'id'       => $user->id,
                'loggedin' => TRUE
            );
            $this->session->set_userdata($data);
            
            return TRUE;
        }
        
        return FALSE;
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
    }
    
    public function loggedin()
    {
        return (bool)$this->session->userdata('loggedin');
    }
    
    public function hash($string)
    {
        return hash('sha512', $string . $this->config->item('encryption_key'));
    }
    
    public function getNew()
    {
        $user = new stdClass();
        $user->name = '';
        $user->email = '';
        $user->passwod = '';
        
        return $user;
    }
}