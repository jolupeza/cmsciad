<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
        return $this->data;
    }
}
