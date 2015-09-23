<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends Admin_Controller
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
        $this->load->model('Role_model');
    }

    public function seed()
    {
        $this->Role_model->truncate();

        $roles = array(
            'Administrator',
            'Editor',
            'Author',
            'Contributor',
            'Subscriber'
        );

        foreach ($roles as $role) {
            $data = array(
                'role' => $role,
                'status' => 1,
            );

            $this->Role_model->save($data);
        }
    }

    public function index()
    {
        // Fetch all roles
        $this->data['roles'] = $this->Role_model->get();

        $this->data['active'] = 'user';
        $this->data['meta_title'] = 'Roles - ' . $this->data['meta_title'];

        // Load view
        $this->data['subview'] = 'admin/role/index';
        $this->load->view('admin/_layout_main', $this->getData());
    }

    public function edit($id = NULL)
    {
        // Fetch a role or set a new one
        if ($id)
        {
            $this->data['role'] = $this->Role_model->get($id);
            count($this->data['role']) || $this->data['errors'][] = 'Role no encontrado.';
        }
        else
        {
            $this->data['role'] = $this->Role_model->getNew();
        }

        // Set up the form
        $rules = $this->Role_model->getRules();
        $id || $rules['password']['rules'] .= '|required';
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE)
        {
            if ($this->input->post('token') == $this->session->userdata('token'))
            {
                $data = $this->Role_model->arrayFromPost(array('role', 'status'));
                $id = $this->Role_model->save($data, $id);
                $this->session->set_flashdata('success', 'Se guardó correctamente.');
                redirect('admin/role/edit/' . $id);
            }
        }

        $this->data['token'] = $this->userlib->token();

        // Load the view
        $this->data['subview'] = 'admin/role/edit';
        $this->load->view('admin/_layout_main', $this->getData());
    }
}
