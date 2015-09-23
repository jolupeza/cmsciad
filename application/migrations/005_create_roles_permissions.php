<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_roles_permissions extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'role_id' => array(
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
        $this->dbforge->create_table('roles_permissions');
        
        //Add foreign key role_id with table roles
        $sql = "ALTER TABLE roles_permissions ADD CONSTRAINT FK_Roles_RP FOREIGN KEY (role_id) "
                . "REFERENCES roles (id) ON UPDATE CASCADE ON DELETE RESTRICT;";
        $this->db->query($sql);
        
        //Add foreign key permission_id with table permissions
        $sql = "ALTER TABLE roles_permissions ADD CONSTRAINT FK_Permissions_RP FOREIGN KEY (permission_id) "
                . "REFERENCES permissions (id) ON UPDATE CASCADE ON DELETE RESTRICT;";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('roles_permissions');
    }
}