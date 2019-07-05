<?php

class Sub_agencies extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/departments_model');
    $this->load->model('api/stations_model');
    $this->load->model('api/sub_agencies_model');
  }

  function department_get($department_id)
  {
    # block for checking if has station ID assigned
    if (!helperValidateStationId($this)) {
      return;
    } 
    # station id is set via $this->station_id
    # / block for checking if has station ID assigned

    $res = $this->sub_agencies_model->allByDepartmentId($department_id);
    $this->response($res, 200);

    $this->response((object) [
  	  'data' => $res,
    	'meta' => (object) [
  	    	'message' => 'Got all data',
  	    	'status' => 200,
     		'code' => 'ok',
     		'station' => $this->stations_model->getStationObj(helperGetStationId($this))
	   ]
    ], 200);
  
  }
   

}
