<?php

class Sub_agencies_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('sub_agencies', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('sub_agencies')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('sub_agencies', array('id' => $id))->row();
  }

  public function allByDepartmentId($department_id)
  {
    return $this->db->get_where('sub_agencies', array('department_id' => $department_id))->result();
  }

}
