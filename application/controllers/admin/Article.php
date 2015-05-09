<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends Admin_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Article_model');
    }
    
    public function index()
    {
        // Fetch all articles
        $this->data['articles'] = $this->Article_model->get();
        
        // Load view
        $this->data['subview'] = 'admin/article/index';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function edit($id = NULL)
    {
        // Fetch a article or set a new one
        if ($id)
        {
            $this->data['article'] = $this->Article_model->get($id);
            count($this->data['article']) || $this->data['errors'][] = 'Article could not be found.';
        }
        else 
        {
            $this->data['article'] = $this->Article_model->getNew();
        }
                
        // Set up the form
        $rules = $this->Article_model->getRules();
        $this->form_validation->set_rules($rules);
        
        // Process the form
        if ($this->form_validation->run() == TRUE)
        {
            $data = $this->Article_model->arrayFromPost(array(
                'title', 
                'slug', 
                'body', 
                'pubdate'
            ));
            $this->Article_model->save($data, $id);
            redirect('admin/article');
        }
        
        // Load the view
        $this->data['subview'] = 'admin/article/edit';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function delete($id)
    {
        $this->Article_model->delete($id);
        redirect('admin/article');
    }
}