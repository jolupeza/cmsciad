<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->driver('session');
        $this->load->library( array('form_validation', 'userlib') );

        $this->load->helper('form');
        $this->load->model('User_model');
        
        $this->data['meta_title'] = $this->config->item('site_name');

        // Login check
        $exception_uris = array(
            'admin/user/login',
            'admin/user/logout',
            'admin/migration',
            'admin/permission/seed',
            'admin/user/seed'
        );

        if ( in_array(uri_string(), $exception_uris) == FALSE )
        {
            if ( $this->userlib->loggedin() == FALSE )
            {
                redirect('admin/user/login');
            }
        }
    }

    /**
     * Validation if select item of select
     * 
     * @param string $value
     * @return boolean
     */
    public function _selectField($value)
    {
        if ( (int)$value <= 0 )
        {
            $this->form_validation->set_message('_selectField', 'Seleccione %s');
            return FALSE;
        }

        return TRUE;
    }
}

/* End of file Admin_Controller.php */
/* Location: ./application/libraries/Admin_Controller.php */