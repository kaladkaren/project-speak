<?php

class Stations_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('stations', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('stations')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('stations', array('id' => $id))->row();
  }

 

}
