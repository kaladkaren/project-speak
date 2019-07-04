<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_stations_rateables_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'station_id' => array(
        'type' => 'INTEGER',
        'constraint' => 9,
        'comment' => 'FK from stations table'
      ),
      'rateable_id' => array(
        'type' => 'INTEGER',
        'constraint' => 9,
        'comment' => 'FK from rateables table'
      ), 
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('stations_rateables'))
    {
      $table = 'stations_rateables';


      # station 1 
      $data = array(
        'station_id' => 1,
        'rateable_id' => 1
      );
      $this->db->insert($table, $data);
      $data = array(
        'station_id' => 1,
        'rateable_id' => 2
      );
      $this->db->insert($table, $data);
      $data = array(
        'station_id' => 1,
        'rateable_id' => 4
      );
      $this->db->insert($table, $data);

      $data = array(
        'station_id' => 1,
        'rateable_id' => 6
      );
      $this->db->insert($table, $data);
       
      $data = array(
        'station_id' => 1,
        'rateable_id' => 7
      );
      $this->db->insert($table, $data);
       
      $data = array(
        'station_id' => 1,
        'rateable_id' => 9
      );
      $this->db->insert($table, $data);     

      $data = array(
        'station_id' => 1,
        'rateable_id' => 10
      );
      $this->db->insert($table, $data);
      
      $data = array(
        'station_id' => 1,
        'rateable_id' => 12
      );
      $this->db->insert($table, $data);
       
      $data = array(
        'station_id' => 1,
        'rateable_id' => 14
      );
      $this->db->insert($table, $data);
 
      # station 2
      $data = array(
        'station_id' => 2,
        'rateable_id' => 2
      );
      $this->db->insert($table, $data);
      $data = array(
        'station_id' => 2,
        'rateable_id' => 3
      );
      $this->db->insert($table, $data);
      $data = array(
        'station_id' => 2,
        'rateable_id' => 4
      );
      $this->db->insert($table, $data);

      $data = array(
        'station_id' => 2,
        'rateable_id' => 8
      );
      $this->db->insert($table, $data);
       
      $data = array(
        'station_id' => 2,
        'rateable_id' => 7
      );
      $this->db->insert($table, $data);
       
      $data = array(
        'station_id' => 2,
        'rateable_id' => 6
      );
      $this->db->insert($table, $data);     

      $data = array(
        'station_id' => 2,
        'rateable_id' => 10
      );
      $this->db->insert($table, $data);
      
      $data = array(
        'station_id' => 2,
        'rateable_id' => 11
      );
      $this->db->insert($table, $data);
       
      $data = array(
        'station_id' => 2,
        'rateable_id' => 13
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('stations_rateables');
  }
}
