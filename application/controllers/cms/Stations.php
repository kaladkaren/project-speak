<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');

  }
 
  public function index()
  {
    // $res = $this->admin_model->all();

    // $data['res'] = $res;
    $this->wrapper('cms/stations');
  }

  function assign()
  {
    $res = $this->devices_model->update(
      $this->input->post('id', true),
      ['station_id' => $this->input->post('station_id', true)]
    );

    if ($res) {
      http_response_code(200);
      echo json_encode(['status' => 'ok']);
    } else {
      http_response_code(400);
      echo json_encode(['status' => 'bad_request']);
    }

  }
}
