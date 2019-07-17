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

  public function update($id, $data)
  {
    $this->db->update('departments', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('departments');
    return $this->db->affected_rows();
  }

}
