<?php

class Options extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/devices_model');
    $this->load->model('api/rateables_model');
  }


  function rateables_post()
  {

    $last_updated = $this->input->post('last_updated');
    $device_id = $this->input->post('device_id');

    $station_id = @$this->devices_model->getByDeviceId($this->input->post('device_id'))->station_id;

    if (!$this->devices_model->checkIfAlreadyRegistered($device_id)){
      $this->response([
          'data' => (object)[],
          'meta' => (object) [
            'message' => 'Device ID is not yet registered',
            'status' => 200,
            'code' => 'not_registered'
          ]
      ], 200);
      return false;
    } if ($station_id === 0) { # if no station ID yet
      $this->response([
          'data' => (object)[],
          'meta' => (object) [
            'message' => 'A station has yet to be assigned to your Device ID. Please contact your administrator for more details.',
            'status' => 200,
            'code' => 'not_assigned'
          ]
      ], 200);
      return false;
    } 

    $res = (object)[];
    $res->rateables = $this->rateables_model->buildOptionsRateables($station_id, $last_updated);
    $res->is_reassigned = $this->rateables_model->checkIfReassigned($station_id, $last_updated);
    
    $this->response([
        'data' => $res,
        'meta' => (object) [
          'message' => 'Got all data',
          'status' => 200,
          'code' => 'ok',
          'datetime' => date('Y-m-d H:i:s'),
        ],
        'request_meta' => (object)[
          'device_id' => $device_id,
          'station_id' => $station_id,
          'last_updated' => $last_updated
        ]
    ], 200);
  }

}
