<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_ratings_table extends CI_Migration {

  public function up()
  {
    # Table PK
    $this->dbforge->add_field('id');

    # Other table fields
    $this->dbforge->add_field(array(
      'rateable_id' => array(
        'type' => 'INT',
        'constraint' => 9,
        'comment' => 'FK from rateables'
      ), 
      'device_id' => array(
        'type' => 'INT',
        'constraint' => 9,
        'comment' => 'FK from devices PK'  # the device id saved in the table
      ), 
      'saved_station_id' => array(
        'type' => 'INT',
        'constraint' => 9,
        'comment' => 'Saved station ID on device\'s local'
      ), 
      'rating' => array(
        'type' => 'INT',
        'constraint' => 9,
        'comment' => '1 (lowest) - 5 (highest)',
        'default' => 1
      ), 
      'rated_at' => array(
        'type' => 'DATETIME',
        'null' => true,
        'default' => null
      ),
      'internal_member_id' => array(
        'type' => 'INT',
        'constraint' => 9,
        'null' => true,
        'comment' => 'Should be null if external member'
      ), 
      'external_member_name' => array(
        'type' => 'TEXT',
        'null' => true,
        'comment' => 'Should be null if internal member'
      ), 
      'department_id' => array(
        'type' => 'INT',
        'constraint' => 9,
        'comment' => 'FK departments table',
        'null' => true,
        'comment' => 'Should be null if internal member'
      ), 
      'sub_agency_id' => array(
        'type' => 'INT',
        'constraint' => 9,
        'comment' => 'FK sub agencies table',
        'null' => true,
        'comment' => 'Should be null if internal member'
      ),  
    ));

    # Table date defaults
    $this->dbforge->add_field("`created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP");
    $this->dbforge->add_field("`updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");


    if($this->dbforge->create_table('ratings'))
    {
      $table = 'ratings';

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
    $this->dbforge->drop_table('ratings');
  }
}
