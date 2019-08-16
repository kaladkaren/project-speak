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

  function getAllStationRateablesObjects()
  {
    $stations = $this->all();
    foreach ($stations as &$value) {
      $value->stations_rateables = $this->getCompleteStationObjects($value->id);
      $value->current_rateables = $this->getStationRateables($value->id);
    }

    return $stations;
  }

  function getStationRateables($station_id)
  {
    $stations_rateables = $this->db->get_where('stations_rateables', ['station_id' => $station_id])->result_array();
    return array_column($stations_rateables, 'rateable_id');
  }

  function getCompleteStationObjects($station_id)
  {
    $stations_rateables = $this->getStationRateables($station_id);
      
    $this->db->select('rateables.id, if(divisions.division_name is null, CONCAT("Unclassified", " - ", rateables.name), CONCAT(divisions.division_name, " - ", rateables.name)) name, rateables.type');
    $this->db->order_by('name', 'asc');
    $this->db->join('divisions', 'rateables.division_id = divisions.id', 'left');
    $rateables = $this->db->get('rateables')->result_array();

    $types = array_column($rateables, 'type');
    $types = array_unique($types); 

    $res = (object)[]; # init our return

    foreach ($types as $value) {
      $res->{$value} = []; # mala imp na galawan?

      foreach ($rateables as $r) {
        if ($r['type'] === $value) {
          unset($r['type']); # tanggal ang epal na type

          $res->{$value}[] = $r;
        }
      }
    }

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

 function getStationObj($station_id)
 {
    $station = $this->db->get_where('stations', array('id' => $station_id))->row();
    return (object)['station_id' => $station_id, 'station_name' => $station->station_name];
 }

}
