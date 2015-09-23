<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
    
    protected $tableName;
    protected $primaryKey;
    protected $primaryFilter;
    protected $orderBy;
    protected $order;
    protected $rules;
    protected $rulesAdmin;
    protected $timestamps;

    public function __construct()
    {
        parent::__construct();
        $this->tableName = '';
        $this->primaryKey = 'id';
        $this->primaryFilter = 'intval';
        $this->orderBy = '';
        $this->order = 'asc';
        $this->rules = array();
        $this->rulesAdmin = array();
        $this->timestamps = FALSE;
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

    public function get($id = NULL, $single = FALSE, $order = TRUE)
    {
        if ($id != NULL)
        {
            $filter = $this->primaryFilter;
            $id = $filter($id);
            $this->db->where($this->primaryKey, $id);
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
        
        if ( $order ) 
        {
            $this->db->order_by($this->orderBy, $this->order);
        }
        
        return $this->db->get($this->tableName)->$method();
    }
    
    public function getBy($where, $single = FALSE)
    {
        $this->db->where($where);
        
        if ( $single )
        {
            return $this->db->get($this->tableName, $single);
        }
        else
        {
            return $this->db->get($this->tableName);
        }
    }
    
    public function save($data, $id = NULL)
    {
        // Set timestamps
        if ($this->timestamps == TRUE)
        {
            $now = date('Y-m-d H:i:s');
            $id || $data['created_at'] = $now;
            is_null($id) || $data['modified_at'] = $now;
        }
        
        // Insert
        if ($id === NULL)
        {
            !isset($data[$this->primaryKey]) || $data[$this->primaryKey] = NULL;
            $this->db->set($data);
            $this->db->insert($this->tableName);
            $id = $this->db->insert_id();
        }
        // Update
        else 
        {
            $filter = $this->primaryFilter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->primaryKey, $id);
            $this->db->update($this->tableName);
        }
        
        return $id;
    }
    
    public function delete($id)
    {
        $filter = $this->primaryFilter;
        $id = $filter($id);
        
        if (!$id)
        {
            return FALSE;
        }
        
        $this->db->where($this->primaryKey, $id);
        $this->db->limit(1);
        return $this->db->delete($this->tableName);
    }
    
    public function truncate()
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');
        $this->db->truncate($this->tableName);
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');
    }
}