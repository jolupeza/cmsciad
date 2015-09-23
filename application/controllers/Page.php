<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Frontend_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
    }
    
    public function index()
    {
        echo 'probando';
    }
}