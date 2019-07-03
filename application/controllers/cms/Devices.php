<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/stations_model');

  }
 
  public function index()
  {
    $data['res'] = $this->devices_model->all();
    $data['stations'] = $this->stations_model->all();
    $default_station = (object)['id' => 0, 'station_name' => 'Unassigned'];
    array_unshift($data['stations'], $default_station);


    $this->wrapper('cms/devices', $data);
  }
}
