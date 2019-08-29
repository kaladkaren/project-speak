<?php

class Departments extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/departments_model');
    $this->load->model('api/stations_model');
  }

  function index_get()
  {
    # block for checking if has station ID assigned
    if (!helperValidateStationId($this)) {
      return;
    } 
    # station id is set via $this->station_id
    # / block for checking if has station ID assigned
    $this->db->order_by('department_name', 'asc');
    $res = $this->departments_model->all();
    $this->response($res, 200);

    $this->response((object) [
  	  'data' => $res,
    	'meta' => (object) [
  	    	'message' => 'Got all data',
  	    	'status' => 200,
     		'code' => 'ok' 
	   ]
    ], 200);
  
  }
   

}
