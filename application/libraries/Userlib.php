<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__).'/Acl.php';

class Userlib
{
    private $CI;
    private $table = 'users';
    private $lang;
    private $acl;
    private $errors = array();
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_username;
    private $user_status;
    private $user_role_id;
    private $user_avatar;
    private $pattern = "/^([-a-z0-9_-])+$/i";

    protected $_primaryFilter;

    public function __construct($options = array())
    {
        $this->CI =& get_instance();

        $this->_primaryFilter = 'intval';

        $this->_set_language(isset($options['lang']) ? $options['lang'] : null);

        $row = null;

        if(isset($options['id']) && (int)$options['id'] > 0) {
            $row = $this->_row(array('id' => (int)$options['id']));

            if(sizeof($row) == 0) {
                show_error($this->CI->lang->line('user_error_invalid_user'));
            }
        } elseif((int) $this->CI->session->userdata('id') > 0) {
            $row = $this->_row(array('id' => $this->CI->session->userdata('id')));

            if(sizeof($row) == 0 || $row->status != 1) {
                $this->CI->session->sess_destroy();
                $this->_load(null);
                return;
            }
        }

        $this->_load($row);
    }

    public function __get($name)
    {
        $property = 'user_' . $name;

        if(isset($this->$property)) {
            return $this->$property;
        }
    }

    public function token()
    {
        $token = md5(uniqid(rand(), true));
        $this->CI->session->set_userdata('token', $token);
        return $token;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function permissions()
    {
        return $this->acl->permissions;
    }

    public function site_permissions()
    {
        return $this->acl->site_permissions;
    }

    public function has_permission($name)
    {
        return $this->acl->has_permission($name);
    }

    public function loggedin()
    {
        return (bool)$this->CI->session->userdata('loggedin');
    }

    public function login($email, $password, $admin = FALSE)
    {
        $where = array(
            'email' => $email,
            'password' => $this->hash($password),
            'status' => 1
        );
        
        if ( $admin )
        {
            $where['role_id'] = 1;
        }
        
        $user = $this->_row($where);

        if ( count($user) )
        {
            // Log in user
            $data = array(
                'name'     => $user->name,
                'email'    => $user->email,
                'id'       => $user->id,
                'role'     => $user->role_id,
                'loggedin' => TRUE
            );
            $this->CI->session->set_userdata($data);

            // Set field las_login
            $data = array( 'last_login' => date('Y-m-d H:i:s') );

            $filter = $this->_primaryFilter;
            $id = $filter($user->id);
            $this->CI->db->set($data);
            $this->CI->db->where('id', $id);
            $this->CI->db->update('users');

            $this->_load($user);
            return TRUE;
        }

        return FALSE;
    }

    private function _load($row = null)
    {
        if ($row == null || sizeof($row) == 0)
        {
            $this->user_id       = 0;
            $this->user_name     = $this->CI->lang->line('cms_general_label_site_visitor_name');
            $this->user_email    = '';
            $this->user_username = '';
            $this->user_status   = 0;
            $this->user_role_id  = 0;
            $this->user_avatar   = '';
            $this->acl           = new Acl(array('lang' => $this->lang));
            return;
        }

        $this->user_id       = $row->id;
        $this->user_name     = $row->name;
        $this->user_email    = $row->email;
        $this->user_username = $row->username;
        $this->user_status   = $row->status;
        $this->user_role_id  = $row->role_id;
        $this->user_avatar   = $row->avatar;
        $this->acl           = new Acl(array('id' => $row->id,'lang' => $this->lang));
    }

    private function _row($where = null, $select = null)
    {
        if(is_array($where)) {
            $this->CI->db->where($where);
        }

        if(is_array($select)) {
            $this->CI->db->select($select);
        }

        return $this->CI->db->get($this->table)->row();
    }

    public function hash($string)
    {
        return hash('sha512', $string . $this->CI->config->item('encryption_key'));
    }

    private function _set_language($lang = null)
    {
        $languages = array('english', 'spanish');

        if( !$lang) {
            if(in_array($this->CI->config->item('language'), $languages)) {
                $lang = $this->CI->config->item('language');
            } else {
                $lang = $languages[0];
            }
        } else {
            if( !in_array($lang, $languages)) {
                $lang = $languages[0];
            }
        }

        $this->lang = $lang;
        $this->CI->load->language('user', $lang);
    }

    public function logout()
    {
        $this->CI->session->sess_destroy();
    }
}

/* End of file User.php */
/* Location: ./application/libraries/User.php */