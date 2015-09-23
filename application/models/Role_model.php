<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->tableName = 'roles';
        $this->orderBy = 'role';
        $this->timestamps = TRUE;
        $this->rules = array(
            'role'    => array(
                'field' => 'role',
                'label' => 'Role',
                'rules' => 'trim|required'
            ),
        );
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getNew()
    {
        $role = new stdClass();
        $role->role = '';
        $role->status = 0;

        return $role;
    }
}
