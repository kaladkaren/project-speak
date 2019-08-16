<?php

class Ratings_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

    $this->per_page = $this->input->get('per_page') ?: 15;
    $this->page = $this->input->get('page') ?: 1;
    $this->offset = (($this->page - 1) * $this->per_page)?: 0;
  }

  public function add($data)
  {
    $this->db->insert('ratings', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('ratings')->result();
    return $res;
  }

  public function buildQueryObjectAllFormatted($paginate = false)
  {
    # station where
    $where_station = ($station_id = $this->input->get('station_id')) ? "ratings.saved_station_id = $station_id": 1;
    
    # device where
    $where_device = ($device_id = $this->input->get('device_id')) ? "ratings.device_id = $device_id": 1;
    
    # where daterange block
    $where_from = $this->input->get('from');
    $where_to = $this->input->get('to');
    if ($where_from && $where_to) {
      $where_date = "DATE(ratings.rated_at) BETWEEN '$where_from' AND '$where_to'";
    } else {
      $where_date = 1;
    }
    # / where daterange block

    # full where string
    if ($where_station || $where_device || $where_date) {
      $where_str = "WHERE $where_station AND $where_device AND $where_date";
    }

    # for our pagination
    $limit_str = ($paginate) ? "LIMIT {$this->per_page} OFFSET {$this->offset}" : '';

    $res = $this->db->query("
      SELECT ratings.id as id, rateables.name as rateable_name, rateables.type as rateable_type, ratings.rating, ratings.rated_at, ratings.comment, DATE_FORMAT(ratings.rated_at, '%M, %d %Y %h:%i:%s %p') as rated_at_formatted,  devices.device_name, stations.station_name, internal_members.full_name, departments.department_name, internal_members.full_name as internal_member_name, ratings.external_member_name as external_member_name, sub_agencies.agency_name, divisions.division_name as division_name
      FROM ratings
      LEFT JOIN rateables ON ratings.rateable_id = rateables.id
      LEFT JOIN devices ON ratings.device_id = devices.id 
      LEFT JOIN stations ON ratings.saved_station_id = stations.id
      LEFT JOIN internal_members ON ratings.internal_member_id = internal_members.id
      LEFT JOIN departments ON ratings.department_id = departments.id
      LEFT JOIN sub_agencies ON ratings.sub_agency_id = sub_agencies.id
      LEFT JOIN divisions ON internal_members.division_id = divisions.id
      $where_str
      ORDER BY ratings.rated_at DESC
      $limit_str 
    ");

    // var_dump($this->db->last_query()); die();
    return $res;
  }

  public function allFormatted($paginate = true)
  {
    $res = $this->buildQueryObjectAllFormatted($paginate)->result();

    foreach ($res as &$value) {
      $value->rating_star = "";
      for ($i = 0; $i < $value->rating; $i++) {
        $value->rating_star .= "⭐";
      }
    }

    return $res;
  }

  function getTotalPages()
  {
    return ceil($this->buildQueryObjectAllFormatted()->num_rows() / $this->per_page);
  }

  public function get($id)
  {
    return $this->db->get_where('ratings', array('id' => $id))->row();
  }

}
