<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_roles extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
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
        $this->dbforge->create_table('roles');
    }

    public function down()
    {
        $this->dbforge->drop_table('roles');
    }
}