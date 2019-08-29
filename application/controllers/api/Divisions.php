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
    $this->db->order_by('division_name', 'asc');
    $this->db->where_not_in('id', [11, 12, 13]); # exclude Finance and Administrative Division (Ground), Finance and Administrative Division (Basement), Finance and Administrative Division (Cashier)
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
