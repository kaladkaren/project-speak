<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_comment_column_for_sync extends CI_Migration {

  $fields = array(
          'comment' => array('type' => 'TEXT', 'null' => true, 'default' => null, 'after' => 'rated_at')
  );
  $this->dbforge->add_column('ratings', $fields);   

  }
  public function down()
  {
    $this->dbforge->drop_column('ratings', 'comment');
  }
}
