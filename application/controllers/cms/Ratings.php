<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ratings extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/ratings_model');
    $this->load->model('api/stations_model');
    $this->load->model('api/devices_model');

  }
 
  public function index()
  {
    $data['res'] =  $this->ratings_model->allFormatted(true);

    $this->db->order_by('device_name', 'asc');
    $data['devices'] = $this->devices_model->all();
    
    $this->db->order_by('station_name', 'asc');
    $data['stations'] = $this->stations_model->all();

    $data['total_pages'] = $this->ratings_model->getTotalPages();

    #pagination shits
    $data['page'] = $this->ratings_model->page;
    $data['per_page'] = $this->ratings_model->per_page;
    $data['starty'] = ($data['page'] == 1) ? 1 : (($data['page'] - 1) * $data['per_page']) + 1;

    $data['device_id'] = $this->input->get('device_id');
    $data['station_id'] = $this->input->get('station_id');
    $data['from'] = $this->input->get('from');
    $data['to'] = $this->input->get('to');

    $this->wrapper('cms/ratings', $data);
  }

  public function export()
  {

    // output headers so that the file is downloaded rather than displayed
    header('Content-type: text/csv');
    header('Content-Disposition: attachment; filename="' . time() . '_ratings.csv"');
    // do not cache the file
    header('Pragma: no-cache');
    header('Expires: 0');
    // create a file pointer connected to the output stream
    $file = fopen('php://output', 'w');
    // send the column headers
    fputcsv($file, array(
      // 'ID', 
      'Device', 'Station', 'Rateable', 'Rating', 'Comment', 'Rated by',
       'Group', 
       'Rated at'));
    
    $res = $this->ratings_model->allFormatted(false);

    $new_res = [];
    foreach ($res as $key => $value) {
      $new_res[] = array(
        // $value->id,
        $value->device_name,
        $value->station_name,
        $value->rateable_name . " ({$value->rateable_type})",
        $value->rating,
        $value->comment,
        ($value->internal_member_name) ? $value->internal_member_name . " (internal)": $value->external_member_name . " (external)",
        ($value->internal_member_name) ? $value->division_name . " (division)" : $value->department_name . " (department) - " . $value->agency_name . " (sub-agency)",
        $value->rated_at_formatted,
      );
    }
    $data = $new_res;

    foreach ($data as $row)
    {
      fputcsv($file, $row);
    }
    exit();
  }

  
}
