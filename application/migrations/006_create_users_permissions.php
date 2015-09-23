<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users_permissions extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'permission_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'value' => array(
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
        $this->dbforge->create_table('users_permissions');
        
        //Add foreign key user_id with table users
        $sql = "ALTER TABLE users_permissions ADD CONSTRAINT FK_Users_UP FOREIGN KEY (user_id) "
                . "REFERENCES users (id) ON UPDATE CASCADE ON DELETE RESTRICT;";
        $this->db->query($sql);
        
        //Add foreign key permission_id with table permissions
        $sql = "ALTER TABLE users_permissions ADD CONSTRAINT FK_Permissions_UP FOREIGN KEY (permission_id) "
                . "REFERENCES permissions (id) ON UPDATE CASCADE ON DELETE RESTRICT;";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('users_permissions');
    }
}