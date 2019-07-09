<?php

class Rateables_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

    $this->full_up_path = base_url() . "uploads/rateables/"; 
  }

  public function add($data)
  {
    $this->db->insert('rateables', $data);
    return $this->db->insert_id();
  }

  public function allByType($type)
  {
    $this->db->where('type', $type);
    $res = $this->db->get('rateables')->result();

    foreach ($res as &$value) {
      $value->image_url = (strpos($value->image_file, 'robohash') !== false) ? $value->image_file : 
        $this->full_up_path . $value->image_file;
    }

    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('rateables', array('id' => $id))->row();
  }


  function allByTypeAndStation($type, $station_id)
  {
    # Get from 3rd table first 
    $stations_rateables = $this->db->get_where('stations_rateables', ['station_id' => $station_id])->result_array();

    $ids_arr = array_column($stations_rateables, 'rateable_id');

    # Get from rateables table with filters
    $this->db->where('type', $type);
    $this->db->where_in('id', $ids_arr);
    $res = $this->db->get('rateables')->result();

    foreach ($res as &$value) {
      $value->image_url = (strpos($value->image_file, 'robohash') !== false) ? $value->image_file : 
        $this->full_up_path . $value->image_file;
    }
    
    return $res;
  }

}