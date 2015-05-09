<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article_model extends MY_Model {

    public function __construct() 
    {
        parent::__construct();
        $this->_tableName = 'articles';
        $this->_orderBy = 'pubdate desc, id desc';
        $this->_timestamps = TRUE;
        $this->_rules = array(
            'pubdate'    => array(
                'field' => 'pubdate', 
                'label' => 'Publication date', 
                'rules' => 'trim|required|exact_length[10]'
            ),
            'title'    => array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_length[100]'),
            'slug'    => array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required|max_length[100]|url_title'),
            'body'    => array('field' => 'body', 'label' => 'Body', 'rules' => 'trim|required'),
        );
    }
    
    public function getRules()
    {
        return $this->_rules;
    }
    
    public function getNew()
    {
        $article = new stdClass();
        $article->title = '';
        $article->slug = '';
        $article->body = '';
        $article->pubdate = date('Y-m-d');
        
        return $article;
    }
}