<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission_model extends MY_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->tableName = 'permissions';
        $this->orderBy = 'title';
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
    }
    
    public function getRules()
    {
        return $this->rules;
    }
    
    public function getNew()
    {
        $permission = new stdClass();
        $permission->title = '';
        $permission->name = '';
        
        return $permission;
    }
}