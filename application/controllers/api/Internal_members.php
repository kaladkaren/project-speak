<?php

class Internal_members extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/internal_members_model');
    $this->load->model('api/stations_model');
  }

  function index_get()
  {
    $this->db->order_by('full_name', 'asc');
    $res = $this->internal_members_model->all();

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
