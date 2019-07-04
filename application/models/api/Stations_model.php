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

  public function update($id, $data)
  {
    $this->db->update('stations', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('stations');
    return $this->db->affected_rows();
  }

 

}
