<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Admin_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Page_model');
    }
    
    public function index()
    {
        // Fetch all pages
        $this->data['pages'] = $this->Page_model->getWithParent();
        
        // Load view
        $this->data['subview'] = 'admin/page/index';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function order()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/page/order';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function orderAjax()
    {
        // Save order from ajax call
        if (isset($_POST['sortable']))
        {
            $this->Page_model->saveOrder($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->Page_model->getNested();
        
        // Load view
        $this->load->view('admin/page/orderAjax', $this->getData());
    }
    
    public function edit($id = NULL)
    {
        // Fetch a page or set a new one
        if ($id)
        {
            $this->data['page'] = $this->Page_model->get($id);
            count($this->data['page']) || $this->data['errors'][] = 'Page could not be found.';
        }
        else 
        {
            $this->data['page'] = $this->Page_model->getNew();
        }
        
        // Pages for dropdown
        $this->data['pages_no_parents'] = $this->Page_model->getNoParents();
        
        // Set up the form
        $rules = $this->Page_model->getRules();
        $this->form_validation->set_rules($rules);
        
        // Process the form
        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->Page_model->arrayFromPost(array('title', 'slug', 'body', 'parent_id'));
            $this->Page_model->save($data, $id);
            redirect('admin/page');
        }
        
        // Load the view
        $this->data['subview'] = 'admin/page/edit';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function delete($id)
    {
        $this->Page_model->delete($id);
        redirect('admin/page');
    }
    
    public function _uniqueSlug($str)
    {
        // Do NOT validate if slug already exists
        // UNLESS it's the slug for the current page
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        $page = $this->Page_model->get();
        
        if (count($page))
        {
            $this->form_validation->set_message('_uniqueSlug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }
}