<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission extends Admin_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        
        // can only be run in the development environment
        if (ENVIRONMENT !== 'development') {
            exit('Wowsers! You don\'t want to do that!');
        }
 
        // initiate faker
        $this->faker = Faker\Factory::create();
 
        // load any required models
        $this->load->model('Permission_model');
    }
    
    public function seed()
    {
        $this->Permission_model->truncate();
        
        $permissions = array(
            array(
                'title' => 'Public',
                'name' => 'public',
            ),
            array(
                'title' => 'Admin access',
                'name' => 'admin_access'
            )
        );
        
        foreach ($permissions as $permission) {
            $data = array(
                'title' => $permission['title'],
                'name' => $permission['name'],
            );
            
            $this->Permission_model->save($data);
        }
    }
}