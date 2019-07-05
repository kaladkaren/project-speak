<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_devices_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'device_id' => array(
        'type' => 'TEXT' 
      ), 
      'device_name' => array(
        'type' => 'TEXT' 
      ),
      'station_id' => array(
        'type' => 'INT', 
        'constraint' => 9,
        'comment' => 'This is its assigned station ID',
        'default' => 0
      )
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");

    if($this->dbforge->create_table('devices'))
    {
      $table = 'devices';

      $data = array(
        'device_id' => 'sphinxofblackquartzjudgemyvow',
        'device_name' => 'Enzo\'s Tablet',
      );
      $this->db->insert($table, $data);

      $data = array(
        'device_id' => 'NJKO987654E32WSXCVY6',
        'device_name' => 'Showroom\'s Tablet',
      );
      $this->db->insert($table, $data);

      $data = array(
        'device_id' => 'NJKO987654E32WSXCVY6',
        'device_name' => '"Hr\'s" Tablet',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('devices');
  }
}
