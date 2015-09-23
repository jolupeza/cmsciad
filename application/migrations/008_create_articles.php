<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_articles extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'body' => array(
                'type' => 'TEXT'
            ),
            'pubdate' => array(
                'type' => 'DATE',
            ),
            'modified' => array(
                'type' => 'DATETIME'
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('articles');
    }

    public function down()
    {
            $this->dbforge->drop_table('articles');
    }
}