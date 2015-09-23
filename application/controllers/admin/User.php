<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        // can only be called from the command line
//        if (!$this->input->is_cli_request()) {
//            exit('Direct access is not allowed');
//        }

        // can only be run in the development environment
        if (ENVIRONMENT !== 'development') {
            exit('Wowsers! You don\'t want to do that!');
        }

        // initiate faker
        $this->faker = Faker\Factory::create();
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
        $this->userlib->loggedin() == FALSE || redirect($dashboard);

        // Set form
        $rules = $this->User_model->getRules();
        $this->form_validation->set_rules($rules);

        // Process form
        if ($this->form_validation->run() == TRUE)
        {
            if ($this->input->post('token') == $this->session->userdata('token'))
            {
                // We can login and redirect
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                if ( $this->userlib->login($email, $password, TRUE) )
                {
                    redirect($dashboard);
                }
                else
                {
                    $this->session->set_flashdata('error', 'Email y password no válidos. Por favor verifica tus datos.');
                    redirect('admin/user/login', 'refresh');
                }
            }
        }

        $this->data['token'] = $this->userlib->token();
        $this->data['meta_title'] = 'Login - ' . $this->data['meta_title'];

        //Load view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_main', $this->getData());
    }

    public function logout()
    {
        $this->userlib->logout();
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

    /**
     * Seeder of user administrator and users of test
     */
    public function seed()
    {
        $this->User_model->truncate();
        $this->seedUserAdmin();
    }

    /**
     * Add user administrator
     */
    private function seedUserAdmin()
    {
        $data = array(
            'name' => 'Suso',
            'email' => 'joseluis@watson.pe',
            'password' => $this->userlib->hash('ABcd1234'),
            'role_id' => 1,
            'status' => 1,
            'created' => 1
        );

        $this->User_model->save($data);
    }
}
