<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'uid' => array(
                'type' => 'VARCHAR',
                'constraint' => 25,
                'null' => TRUE
            ),
            'dni' => array(
                'type' => 'CHAR',
                'constraint' => 8,
                'null' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null' => TRUE
            ),
            'avatar' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'role_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 5
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ),
            'last_login' => array(
                'type' => 'DATETIME',
                'default' => '0000-00-00 00:00:00'
            ),
            'activation_code' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
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
        $this->dbforge->create_table('users');
        
        //Add foreign key role_id with table roles
        $sql = "ALTER TABLE users ADD CONSTRAINT FK_Roles_Users FOREIGN KEY (role_id) "
                . "REFERENCES roles (id) ON UPDATE CASCADE ON DELETE RESTRICT;";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}