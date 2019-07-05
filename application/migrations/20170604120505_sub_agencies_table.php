<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_sub_agencies_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'agency_name' => array(
        'type' => 'VARCHAR',
        'constraint' => '300',
      ),
      'department_id' => array(
        'type' => 'INT',
        'constraint' => '9',
        'comment' => 'FK',
      ),
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('sub_agencies'))
    {
      $table = 'sub_agencies';

      $data = array(
        'agency_name' => 'Anti-drugs division',
        'department_id' => 1,
      );
      $this->db->insert($table, $data);

      $data = array(
        'agency_name' => 'Anti-terrorism division',
        'department_id' => 1,
      );
      $this->db->insert($table, $data);
      
      $data = array(
        'agency_name' => 'Example agency',
        'department_id' => 2,
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('sub_agencies');
  }
}
