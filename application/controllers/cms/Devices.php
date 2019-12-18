<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Devices extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/ratings_model');
    $this->load->model('api/stations_model');
    $this->load->model('api/rateables_model');

  }
 
  public function index()
  {
    $this->db->order_by('device_name', 'asc');
    $data['res'] = $this->devices_model->all();
    $data['stations'] = $this->stations_model->all();
    $default_station = (object)['id' => 0, 'station_name' => 'Unassigned'];
    array_unshift($data['stations'], $default_station);


    $this->wrapper('cms/devices', $data);
  }

  function summary($device_id)
  {
    $data = [];

    $data['from'] = $this->input->get('from');
    $data['to'] = $this->input->get('to');
    // $data = $this->rateables_model->getRateablesPerDevice($device_id, $start_date, $end_date);

    $data['device'] = $this->devices_model->get($device_id);
    $data['station'] = $this->stations_model->get($data['device']->station_id);
    $data['rateables'] = $this->rateables_model->getRateables($data['device']->station_id);


    # ##############
    # Services
    # ##############
    $data['services'] = $this->ratings_model->getDeviceRatingsPerType($device_id, 'services', $data['from'], $data['to']);
    $data['services_rateable_ids'] = [];
    foreach ($data['services'] as $value) {
      $data['services_rateable_ids'][] = $value->id;
    }
    $data['services_zero']= $this->ratings_model->createZeroRatings($data['rateables'], $data['services_rateable_ids'], 'services');

    // var_dump($data['services_rateable_ids'], $data['services_zero'], $data['services']); die();

    # ##############
    # People
    # ##############
    $data['people'] = $this->ratings_model->getDeviceRatingsPerType($device_id, 'people', $data['from'], $data['to']);
    $data['people_rateable_ids'] = [];
    foreach ($data['people'] as $value) {
      $data['people_rateable_ids'][] = $value->id;
    }
    $data['people_zero'] = $this->ratings_model->createZeroRatings($data['rateables'], $data['people_rateable_ids'], 'people');
    // var_dump($data['people'], $data['people_rateable_ids'], $data['people_zero']); die();

    # ##############
    # Experience
    # ##############
    $data['experience'] = $this->ratings_model->getDeviceRatingsPerType($device_id, 'experience', $data['from'], $data['to']);
    $data['experience_rateable_ids'] = [];
    foreach ($data['experience'] as $value) {
      $data['experience_rateable_ids'][] = $value->id;
    }
    $data['experience_zero'] = $this->ratings_model->createZeroRatings($data['rateables'], $data['experience_rateable_ids'], 'experience'); 

  
    // var_dump($data['services_zero'],$data['people_zero'],$data['experience_zero']); die();

    $this->wrapper('cms/devices_summary', $data);
  }
}
