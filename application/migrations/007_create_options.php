<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_options extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'option_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 64
            ),
            'option_value' => array(
                'type' => 'LONGTEXT'
            ),
            'created' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'default' => '0000-00-00 00:00:00'
            ),
            'modified' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0
            ),
            'modified_at' => array(
                'type' => 'DATETIME',
                'default' => '0000-00-00 00:00:00'
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('options');
    }

    public function down()
    {
        $this->dbforge->drop_table('options');
    }
}