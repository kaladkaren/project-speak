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

      $data = array(
        'name' => 'Tanning',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'services',
        'image_file' => "https://robohash.org/".time().".png?set=set1"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Smithing',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'services',
        'image_file' => "https://robohash.org/".(time()+1).".png?set=set1"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Woodworking',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'services',
        'image_file' => "https://robohash.org/".(time()+2).".png?set=set1"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Metalworking',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'services',
        'image_file' => "https://robohash.org/".(time()+3).".png?set=set1"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Baking',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'services',
        'image_file' => "https://robohash.org/".(time()+4).".png?set=set1"
      );
      $this->db->insert($table, $data); # 5

      $data = array(
        'name' => 'Gold Experience',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'experience',
        'image_file' => "https://robohash.org/".(time()+1).".png?set=set2"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Some Experience',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'experience',
        'image_file' => "https://robohash.org/".(time()+2).".png?set=set2"
      );

      $data = array(
        'name' => 'Test Experience',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'experience',
        'image_file' => "https://robohash.org/".(time()+3).".png?set=set2"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Hello Experience',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'experience',
        'image_file' => "https://robohash.org/".(time()+4).".png?set=set2"
      );
      $this->db->insert($table, $data);  

      $data = array(
        'name' => 'Magen Attraglaitz',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'people', 
        'image_file' => "https://robohash.org/".(time()+5).".png?set=set5" # 10
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Sin Grey Audragonel',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'people',
        'image_file' => "https://robohash.org/".(time()+6).".png?set=set5"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Godfrey Fvjyana',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'people',
        'image_file' => "https://robohash.org/".(time()+7).".png?set=set5"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Arthis Grinsley',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'people',
        'image_file' => "https://robohash.org/".(time()+8).".png?set=set5"
      );
      $this->db->insert($table, $data);

      $data = array(
        'name' => 'Cain Rosef Attraglaitz',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        'type' => 'people',
        'image_file' => "https://robohash.org/".(time()+9).".png?set=set5" # 14
      );
      $this->db->insert($table, $data);

    }
  }

  public function down()
  {
    $this->dbforge->drop_table('rateables');
  }
}
