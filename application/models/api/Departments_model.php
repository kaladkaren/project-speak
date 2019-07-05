<?php

class Departments_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('departments', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('departments')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('departments', array('id' => $id))->row();
  }

}
