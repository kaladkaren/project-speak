<?php

class Divisions_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('divisions', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('divisions')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('divisions', array('id' => $id))->row();
  }


}
