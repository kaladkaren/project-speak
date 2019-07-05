<?php

class Divisions extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/divisions_model');
  }

  function index_get()
  {
    $res = $this->divisions_model->all();
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
