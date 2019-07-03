<?php

class Ratings extends Crud_controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->model('api/ratings_model');

  }


  function index_post()
  {
    # block for checking if has station ID assigned
    if (!helperValidateStationId($this)) {
      return;
    } 
    # station id is set via $this->station_id
    # / block for checking if has station ID assigned

  	# check first if exist
  	if ($this->ratings_model->add($this->input->post(true))) {
  	  
  	  $this->response((object) [
        	'data' => (object)[],
        	'meta' => (object) [
        		'message' => 'Rating successful',
        		'status' => 201,
        		'code' => 'created'
        	]
        ], 200);
  	  return;
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
