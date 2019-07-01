<?php

class Devices extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/devices_model');
  }


  function index_post()
  {
  	# check first if exist
	if ($this->devices_model->checkIfAlreadyRegistered($this->input->post('device_id'))) {
	  
	  $this->response((object) [
      	'data' => (object)[],
      	'meta' => (object) [
      		'message' => 'Device already registered before',
      		'status' => 200,
      		'code' => 'already_exists'
      	]
      ], 200);
	  return;
	}
    
	$last_id = $this->devices_model->add($this->input->post());

    if($last_id){ # Try to add and get the last id
      $res = $this->devices_model->get($last_id); # Get the last entry data
      
      $this->response((object) [
      	'data' => $res,
      	'meta' => (object) [
      		'message' => 'Successfully registered device',
      		'status' => 200,
      		'code' => 'ok'
      	]
      ], 200);

    }else{ # end if $last_id
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
