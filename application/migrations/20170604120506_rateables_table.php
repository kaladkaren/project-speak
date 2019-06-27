<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_rateables_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'name' => array(
        'type' => 'TEXT',
      ), 
      'description' => array(
        'type' => 'TEXT',
      ), 
      'type' => array(
        'type' => 'VARCHAR',
        'constraint' => '140',
        'comment' => 'Initially `services`, `experience`, and `people`'
      ), 
      'image_file' => array(
        'type' => 'TEXT',
        'comment' => 'Filename. Ex: my_image.png'
      ), 
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('rateables'))
    {
      $table = 'rateables';

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
    $this->dbforge->drop_table('rateables');
  }
}
