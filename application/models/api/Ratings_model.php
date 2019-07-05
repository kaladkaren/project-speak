<?php

class Ratings_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('ratings', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('ratings')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('ratings', array('id' => $id))->row();
  }

}
