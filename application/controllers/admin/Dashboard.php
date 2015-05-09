<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct() 
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main', $this->getData());
    }
    
    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->getData());
    }
}