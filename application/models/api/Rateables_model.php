<?php

class Rateables_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

  }

  public function add($data)
  {
    $this->db->insert('rateables', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('rateables')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('rateables', array('id' => $id))->row();
  }


  function allByType($type, $station_id)
  {
    # Get from 3rd table first 
    $stations_rateables = $this->db->get_where('stations_rateables', ['station_id' => $station_id])->result_array();

    $ids_arr = array_column($stations_rateables, 'rateable_id');

    # Get from rateables table with filters
    $this->db->where('type', $type);
    $this->db->where_in('id', $ids_arr);
    return $this->db->get('rateables')->result();
  }

}