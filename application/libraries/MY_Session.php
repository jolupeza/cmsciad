<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Session extends CI_Session {
    
    public function sess_regenerate()
    {
        // Listen to HTTP_X_REQUESTED_WITH
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest')
        {
            parent::sess_regenerate();
        }
    }
}