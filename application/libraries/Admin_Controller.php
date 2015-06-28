<?php defined('BASEPATH') OR exit('No direct script access allowed');

 class Admin_Controller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['meta_title'] = "My awesome CMS";
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('User_model');

        // Login check
        $exception_uris = array(
            'admin/user/login',
            'admin/user/logout'
        );

        if (in_array(uri_string(), $exception_uris) == FALSE)
        {
            if ($this->User_model->loggedin() == FALSE)
            {
                redirect('admin/user/login');
            }
        }
    }
}

