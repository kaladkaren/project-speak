<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ratings extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/ratings_model');
    $this->load->model('api/stations_model');
    $this->load->model('api/devices_model');
    $this->load->model('api/rateables_model');

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

    $data['name'] = $this->input->get('name');
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

  function summary($rateable_id = 0)
  {
    $rateable = $this->rateables_model->get($rateable_id);
    $data['rateable_name'] = $rateable->name;
    $data['rateable_id'] = $rateable->id;

    # kailangan eh
    
    # where daterange block
    $where_from = $this->input->get('from');
    $where_to = $this->input->get('to');
    if ($where_from && $where_to) {
      $where_date = "DATE(ratings.rated_at) BETWEEN '$where_from' AND '$where_to'";
    } else {
      $where_date = 1;
    }
    # / where daterange block
    $q = $this->db->query("SELECT COUNT(ratings.rating) as county, (rating * COUNT(ratings.rating)) as ratingsy, ratings.* FROM `ratings` WHERE rateable_id = $rateable_id AND $where_date GROUP BY rating ORDER BY rating DESC");

    $comments_q = $this->db->query("
      SELECT ratings.id as id, rateables.name as rateable_name, rateables.type as rateable_type, ratings.rating, ratings.rateable_id, ratings.rated_at, ratings.comment, DATE_FORMAT(ratings.rated_at, '%M, %d %Y %h:%i:%s %p') as rated_at_formatted,  devices.device_name, stations.station_name, internal_members.full_name, departments.department_name, internal_members.full_name as internal_member_name, ratings.external_member_name as external_member_name, sub_agencies.agency_name, divisions.division_name as division_name
      FROM ratings
      LEFT JOIN rateables ON ratings.rateable_id = rateables.id
      LEFT JOIN devices ON ratings.device_id = devices.id 
      LEFT JOIN stations ON ratings.saved_station_id = stations.id
      LEFT JOIN internal_members ON ratings.internal_member_id = internal_members.id
      LEFT JOIN departments ON ratings.department_id = departments.id
      LEFT JOIN sub_agencies ON ratings.sub_agency_id = sub_agencies.id
      LEFT JOIN divisions ON internal_members.division_id = divisions.id
      WHERE ratings.rateable_id = $rateable_id AND $where_date 
      AND (ratings.comment IS NOT NULL AND ratings.comment != '') 
      GROUP BY ratings.comment ORDER BY rated_at DESC");

      // SELECT ratings.*, DATE_FORMAT(ratings.rated_at, '%M, %d %Y %h:%i:%s %p') as rated_at_formatted FROM `ratings` WHERE rateable_id = $rateable_id AND $where_date GROUP BY comment ORDER BY rating DESC

    $summary = $q->result();
    $summary_arr = $q->result_array();

    $county = array_column($summary_arr, 'county');
    $ratingsy = array_column($summary_arr, 'ratingsy');

    $total = array_sum($county);
    
    $data['average'] = round(array_sum($ratingsy) / $total, 2);

    foreach ($summary as &$value) {
      $value->p = ($value->county / $total) * 100;
    }


    $data['comments'] = $comments_q->result();
    $data['summary'] = $summary;
    $data['total'] = $total;
    $data['from'] = $this->input->get('from');
    $data['to'] = $this->input->get('to');

    $this->wrapper('cms/rating-summary', $data);
  }

  
}
