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
    $res = $this->sub_agencies_model->allByDepartmentId($department_id);
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

  function index_get()
  {
    $this->db->order_by('agency_name', 'asc');
    $res = $this->sub_agencies_model->all();
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
