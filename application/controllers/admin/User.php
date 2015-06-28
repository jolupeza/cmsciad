<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

    public function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        // Fetch all users
        $this->data['users'] = $this->User_model->get();
        
        // Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function edit($id = NULL)
    {
        // Fetch a user or set a new one
        if ($id)
        {
            $this->data['user'] = $this->User_model->get($id);
            count($this->data['user']) || $this->data['errors'][] = 'User could not be found.';
        }
        else 
        {
            $this->data['user'] = $this->User_model->getNew();
        }
        
        // Set up the form
        $rules = $this->User_model->getRulesAdmin();
        $id || $rules['password']['rules'] .= '|required';
        $this->form_validation->set_rules($rules);
        
        // Process the form
        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->User_model->arrayFromPost(array('name', 'email', 'password'));
            $data['password'] = $this->User_model->hash($data['password']);
            $this->User_model->save($data, $id);
            $this->session->set_flashdata('success', 'Se guardó correctamente.');
            redirect('admin/user');
        }
        
        // Load the view
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function delete($id)
    {
        if ( $this->User_model->delete($id) )
        {
            $this->session->set_flashdata('info', 'Se eliminó correctamente.');
        }
        redirect('admin/user');
    }

    public function login()
    {        
        // Redirect a user if he's already logged in
        $dashboard = 'admin/dashboard';
        $this->User_model->loggedin() == FALSE || redirect($dashboard);
        
        // Set form
        $rules = $this->User_model->getRules();
        $this->form_validation->set_rules($rules);
        
        // Process form
        if ($this->form_validation->run() == TRUE)
        {
            // We can login and redirect
            if ($this->User_model->login() == TRUE)
            {
                redirect($dashboard);
            }
            else 
            {
                $this->session->set_flashdata('error', 'That email/password combination does not exist');
                redirect('admin/user/login', 'refresh');
            }
        }
        
        // Load view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function logout()
    {
        $this->User_model->logout();
        redirect('admin/user/login');
    }
    
    public function _uniqueEmail($str)
    {
        // Do NOT validate if email already exists
        // UNLESS it's the email for the currentuser
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->User_model->get();
        
        if (count($user))
        {
            $this->form_validation->set_message('_uniqueEmail', '%s ya se encuentra registrado.');
            return FALSE;
        }
        
        return TRUE;
    }
}