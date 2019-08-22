<?php

class Ratings extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/ratings_model');
    $this->load->model('api/devices_model');
    $this->load->model('api/sub_agencies_model');

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
    
    # block for checking others / custom_sub_agency
    $custom_sub_agency = $this->input->post('custom_sub_agency');
    if ($custom_sub_agency && !$this->sub_agencies_model->getByAgencyName($custom_sub_agency)) {
      $insert_id = $this->sub_agencies_model->add(['agency_name' => $this->input->post('custom_sub_agency'),
       'department_id' => $this->input->post('department_id')]);

      $data['sub_agency_id'] = $insert_id;
    } else{
      $data['sub_agency_id'] = $this->sub_agencies_model->getByAgencyName($custom_sub_agency)->id;
    }
    unset($data['custom_sub_agency']);
    # / block for checking others / custom_sub_agency

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
