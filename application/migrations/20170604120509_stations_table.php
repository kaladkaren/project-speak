<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_stations_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'station_name' => array(
        'type' => 'TEXT' 
      ) 
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");

    if($this->dbforge->create_table('stations'))
    {
      $table = 'stations';

      $data = array(
        'station_name' => 'Delhatti Spire',
      );
      $this->db->insert($table, $data);

      $data = array(
        'station_name' => 'Rotun Dale Magical Library',
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('stations');
  }
}
