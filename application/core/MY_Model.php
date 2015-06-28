<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    protected $_tableName;
    protected $_primaryKey;
    protected $_primaryFilter;
    protected $_orderBy;
    protected $_rules;
    protected $_rulesAdmin;
    protected $_timestamps;

    public function __construct()
    {
        parent::__construct();
        $this->_tableName = '';
        $this->_primaryKey = 'id';
        $this->_primaryFilter = 'intval';
        $this->_orderBy = '';
        $this->_rules = array();
        $this->_rulesAdmin = array();
        $this->_timestamps = FALSE;
    }
    
    public function arrayFromPost($fields)
    {
        $data = array();
        foreach ($fields as $field) 
        {
            $data[$field] = $this->input->post($field);
        }
        
        return $data;
    }

    public function get($id = NULL, $single = FALSE)
    {
        if ($id != NULL)
        {
            $filter = $this->_primaryFilter;
            $id = $filter($id);
            $this->db->where($this->_primaryKey, $id);
            $method = 'row';
        }
        elseif ($single == TRUE)
        {
            $method = 'row';
        }
        else 
        {
            $method = 'result';
        }
        
        //if (!count($this->db->ar_orderby)) 
        //{
            $this->db->order_by($this->_orderBy);
        //}
        
        return $this->db->get($this->_tableName)->$method();
    }
    
    public function getBy($where, $single = FALSE)
    {
        $this->db->where($where);
        return $this->db->get($this->_tableName, $single);
    }
    
    public function save($data, $id = NULL)
    {
        // Set timestamps
        if ($this->_timestamps == TRUE)
        {
            $now = date('Y-m-d H:i:s');
            $id || $data['modified'] = $now;
            $data['modified'] = $now;
        }
        
        // Insert
        if ($id === NULL)
        {
            !isset($data[$this->_primaryKey]) || $data[$this->_primaryKey] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_tableName);
            $id = $this->db->insert_id();
        }
        // Update
        else 
        {
            $filter = $this->_primaryFilter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primaryKey, $id);
            $this->db->update($this->_tableName);
        }
        
        return $id;
    }
    
    public function delete($id)
    {
        $filter = $this->_primaryFilter;
        $id = $filter($id);
        
        if (!$id)
        {
            return FALSE;
        }
        
        $this->db->where($this->_primaryKey, $id);
        $this->db->limit(1);
        return $this->db->delete($this->_tableName);
    }
}