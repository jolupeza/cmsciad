<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_sessions extends CI_Migration {

    public function up()
    {        
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constraint' => '40',
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => '45',
            ),
            'timestamp' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'default' => 0
            ),
            'data' => array(
                'type' => 'BLOB',
            ),
        ));
        
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('ci_sessions');
        $this->db->query('ALTER TABLE `ci_sessions` ADD KEY `timestamp_idx` (`timestamp`)');
    }

    public function down()
    {
            $this->dbforge->drop_table('ci_sessions');
    }
}