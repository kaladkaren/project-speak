<?php

class Devices_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('devices', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('devices')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('devices', array('id' => $id))->row();
  }

  function checkIfAlreadyRegistered($device_id = null)
  {
  	$this->db->where('device_id', $device_id);
  	return $this->db->count_all_results('devices');
  }

}
