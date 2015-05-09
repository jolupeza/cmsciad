<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends MY_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->_tableName = 'pages';
        $this->_orderBy = 'order';
        $this->_rules = array(
            'parent_id'    => array('field' => 'parent_id', 'label' => 'Parent', 'rules' => 'trim|intval'),
            'title'    => array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[100]'),
            'slug'    => array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required|max_length[100]|url_title|callback__uniqueSlug'),
            'body'    => array('field' => 'body', 'label' => 'Body', 'rules' => 'trim|required'),
        );
    }
    
    public function getRules()
    {
        return $this->_rules;
    }
    
    public function getNew()
    {
        $page = new stdClass();
        $page->title = '';
        $page->slug = '';
        $page->body = '';
        $page->parent_id = 0;
        
        return $page;
    }
    
    public function delete($id)
    {
        // Delete a page
        parent::delete($id);
        
        // Reset parent ID for its children
        $this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_tableName);
    }
    
    public function saveOrder($pages) 
    {
        if (count($pages))
        {
            foreach ($pages as $order => $page) 
            {
                if ($page['item_id'] != '')
                {
                    $data = array('parent_id' => (int)$page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primaryKey, $page['item_id'])->update($this->_tableName);
                }
            }
        }
    }
    
    public function getNested()
    {
        $pages = $this->db->get('pages')->result_array();
        
        $array = array();
        foreach ($pages as $page) 
        {
            if (!$page['parent_id']) 
            {
                $array[$page['id']] = $page;
            }
            else 
            {
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        
        return $array;
    }

    public function getWithParent($id = NULL, $single = FALSE)
    {
        $this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('pages p', 'pages.parent_id = p.id', 'left');
        return parent::get($id, $single);
    }
    
    public function getNoParents()
    {
        // Fetch pages without parents
        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $pages = parent::get();
        
        // Return key => value pair array
        $array = array(0 => 'No parent');
        if (count($pages))
        {
            foreach($pages as $page)
            {
                $array[$page->id] = $page->title;
            }
        }
        return $array;
    }
}