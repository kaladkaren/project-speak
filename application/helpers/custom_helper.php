<?php

/**
* returns the api url
* @param  object $class    the `$this` object
* @return string           example: http://localhost/restigniter-crud/api/crud/27
*
* @author: @jjjjcccjjf
*/
function api_url($class)
{
  return base_url() . "api/" . strtolower(get_class($class)) . "/";
}

function helperGetDeviceIdHeader($that){
	$headers = $that->input->request_headers(true);
	return @$headers['DEVICE-ID'];
}

/**
 * $that is used as $this
 * @param  [type] $that [description]
 * @return [type]       [description]
 */
function helperGetStationId($that)
{
  $device_id = helperGetDeviceIdHeader($that); # get device id from header

  if (!$device_id) {
  	return null; # to distinguish empty device ID with empty station ID
  }

  $station_id = @$that->db->get_where('devices', ['device_id' => $device_id])->row()->station_id;
  return ($station_id) ?: 0;
}

/**
 * call this to check if the device has a station assigned to it
 * @param  [type] $that [description]
 * @return [type]       [description]
 */
function helperValidateStationId($that){

  $station_id = helperGetStationId($that);



  if ($station_id === 0) { # if no station ID yet
  	$that->response([
      	'data' => (object)[],
      	'meta' => (object) [
      		'message' => 'Station not yet assigned. Please contact your administrator for more details.',
      		'status' => 403,
      		'code' => 'forbidden'
      	]
  	], 403);
  	return false; # stop the fn here
  } else if ($station_id === null) { # if NO DEVICE ID
  	$that->response([
      	'data' => (object)[],
      	'meta' => (object) [
      		'message' => 'Please provide a DEVICE-ID http header in your request to proceed.',
      		'status' => 403,
      		'code' => 'forbidden'
      	]
  	], 403);
  	return false; # stop the fn here
  } 

  # do nothing if has station_id ~
}