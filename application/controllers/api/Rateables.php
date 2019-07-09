<?php

class Rateables extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/rateables_model');
    $this->load->model('api/devices_model');
    $this->load->model('api/stations_model');

  }

  function rateables_get($type)
  {
    # block for checking if has station ID assigned
    if (!helperValidateStationId($this)) {
      return;
    } 

    $station_id = helperGetStationId($this);
    # station id is set via $this->station_id
    # / block for checking if has station ID assigned
    
    switch ($type) {
        case 'services':
        case 'experience':
        case 'people':
        $this->getRateable($type, $station_id);
        break;
      
      default:
        
        $this->response((object) [
        'data' => (object)[],
        'meta' => (object) [
          'message' => 'Invalid rateable type',
          'status' => 400,
          'code' => 'bad_request'
        ]
      ], 400);

        break;
    } # end switch
  } # end index_get

  function getRateable($type, $station_id)
  {
    $res = $this->rateables_model->allByTypeAndStation($type, $station_id);
    
    $this->response((object) [
      'data' => $res,
      'meta' => (object) [
        'message' => 'Got all data',
        'status' => 200,
        'code' => 'ok',
        'station' => $this->stations_model->getStationObj($station_id)
      ]
    ], 200);
  }

}
