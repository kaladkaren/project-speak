<?php

class Ratings extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/ratings_model');
    $this->load->model('api/devices_model');

  }


  function index_post()
  {
    # block for checking if has station ID assigned
    if (!helperValidateStationId($this)) {
      return;
    } 
    # station id is set via $this->station_id
    # / block for checking if has station ID assigned

    $device_id_pk = $this->devices_model->getByDeviceId(helperGetDeviceIdHeader($this))->id;
    $data = array_merge($this->input->post(null, true), ['device_id' => $device_id_pk]);
    
    # try to add
  	if ($this->ratings_model->add($data)) {
  	  
  	  $this->response((object) [
        	'data' => (object)[],
        	'meta' => (object) [
        		'message' => 'Sync success',
        		'status' => 200,
        		'code' => 'created'
        	]
        ], 200);
  	  
  	} else{ # end if $last_id
      $this->response((object) [
      	'data' => (object)[],
      	'meta' => (object) [
      		'message' => 'Malformed syntax',
      		'status' => 400,
      		'code' => 'bad_request'
      	]
      ], 400);
    } # end else

  }

}
