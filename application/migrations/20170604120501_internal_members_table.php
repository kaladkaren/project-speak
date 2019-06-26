<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_internal_members_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'name' => array(
        'type' => 'VARCHAR',
        'constraint' => '300',
      ),
      'division_id' => array(
        'type' => 'INT',
        'constraint' => '9',
        'comment' => 'FK'
      )
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('internal_members'))
    {
      $table = 'internal_members';

      // $data = array(
      //   'some_varchar_field' => 'Veroem ipsum adasdasd',
      //   'some_text_field' => 'Hooooh',
      //   'some_int_field' => '123',
      //   'some_datetime_field' => ''
      // );
      // $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('internal_members');
  }
}
