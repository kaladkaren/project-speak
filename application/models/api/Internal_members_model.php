<?php

class Internal_members_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('internal_members', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('internal_members')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('internal_members', array('id' => $id))->row();
  }

}
