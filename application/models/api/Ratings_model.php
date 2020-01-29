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

  function getDeviceRatingsPerType($device_id, $type = 'services', $scope = 'internal', $from = null, $to = null)
  {
    $where_string = 1;
    if ($from && $to) {
      $where_string = "(ratings.rated_at >= '$from' AND ratings.rated_at <= '$to')";
    }

    // var_dump($from, $to, $where_string); die();
    $res = $this->db->query("SELECT rateables.id as id, 
     GROUP_CONCAT(ratings.id SEPARATOR ' ') as rating_ids,
      rateables.name as name,
      rateables.type, 
      AVG(ratings.rating) as ratingy,
      count(ratings.rating) as total,
      IF(rateables.scope is NULL OR rateables.scope = '', 'internal/external', rateables.scope) as scope,
      ((AVG(ratings.rating) / count(ratings.rating)) * 100) as perc
       FROM `ratings`
      LEFT JOIN rateables ON ratings.rateable_id = rateables.id
      WHERE device_id = $device_id AND type = '{$type}' AND $where_string 
      AND (scope = '$scope' OR scope IS NULL OR scope = '')
      GROUP BY ratings.rateable_id  
      ORDER BY ratingy DESC")->result();
    // var_dump($this->db->last_query()); die();
     
    return $res;
  }

  function formatAppendDeviceComments(&$data)
  {
    $res = [];
    foreach ($data as $value) {
      $comments = [];
      $rating_ids = explode(" ", $value->rating_ids);
      foreach($rating_ids as $rating_id) {
        $comments[] = $this->get($rating_id);
      }
      $value->comments = $comments;

      $res[] = $value;
    }

    return $res;
  }

  function createZeroRatings($rateables = [], $rateable_ids_exclude = [], $type = 'services') {
    if (!$rateables)  # rateables ng station na yon
      return [];
    // var_dump($rateables); die();
    $res = [];

    foreach($rateables as $value){
      # if not exclude and correct type
      // var_dump(!in_array($value->id, $rateable_ids_exclude), $value->type == $type, $value->id); die();
      if (!in_array($value->id, $rateable_ids_exclude) && $value->type == $type) {
        $res[] = $value;
      }
    }
    // var_dump($res, $rateables, $rateable_ids_exclude); die();
    return $res;
  }

  public function buildQueryObjectAllFormatted($paginate = false)
  {
    # station where
    $where_station = ($station_id = $this->input->get('station_id')) ? "ratings.saved_station_id = $station_id": 1;
    
    # device where
    $where_device = ($device_id = $this->input->get('device_id')) ? "ratings.device_id = $device_id": 1;
    
    # device where
    $where_name = ($name = $this->input->get('name')) ? "(rateables.name LIKE '%$name%' OR ratings.other_rateable_name LIKE '%$name%')": 1;
    
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
      $where_str = "WHERE $where_station AND $where_device AND $where_date AND $where_name";
    }

    # for our pagination
    $limit_str = ($paginate) ? "LIMIT {$this->per_page} OFFSET {$this->offset}" : '';

    $res = $this->db->query("
      SELECT ratings.id as id, rateables.name as rateable_name, rateables.type as rateable_type, ratings.rating, ratings.rateable_id, ratings.rated_at, ratings.comment, DATE_FORMAT(ratings.rated_at, '%M, %d %Y %h:%i:%s %p') as rated_at_formatted,  devices.device_name, stations.station_name, internal_members.full_name, departments.department_name, internal_members.full_name as internal_member_name, ratings.external_member_name as external_member_name, sub_agencies.agency_name, divisions.division_name as division_name, ratings.comment_type, ratings.other_rateable_name
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

  function getComments($rateable_id, $where_date)
  {
    return $this->db->query("
      SELECT ratings.id as id, rateables.name as rateable_name, rateables.type as rateable_type, ratings.rating, ratings.rateable_id, ratings.rated_at, 
        IF(ratings.comment IS NULL OR ratings.comment = '', 'N/A', ratings.comment) as comment,
        DATE_FORMAT(ratings.rated_at, '%M, %d %Y %h:%i:%s %p') as rated_at_formatted,  devices.device_name, stations.station_name, internal_members.full_name, departments.department_name, internal_members.full_name as internal_member_name, ratings.external_member_name as external_member_name, sub_agencies.agency_name, divisions.division_name as division_name, ratings.comment_type, ratings.other_rateable_name
      FROM ratings
      LEFT JOIN rateables ON ratings.rateable_id = rateables.id
      LEFT JOIN devices ON ratings.device_id = devices.id 
      LEFT JOIN stations ON ratings.saved_station_id = stations.id
      LEFT JOIN internal_members ON ratings.internal_member_id = internal_members.id
      LEFT JOIN departments ON ratings.department_id = departments.id
      LEFT JOIN sub_agencies ON ratings.sub_agency_id = sub_agencies.id
      LEFT JOIN divisions ON internal_members.division_id = divisions.id
      WHERE ratings.rateable_id = $rateable_id AND $where_date 
      AND ((ratings.comment IS NOT NULL AND ratings.comment != '') OR ratings.other_rateable_name IS NOT NULL)  
      GROUP BY ratings.id ORDER BY rated_at DESC")->result();
  }

  public function allFormatted($paginate = true)
  {
    $res = $this->buildQueryObjectAllFormatted($paginate)->result();

    foreach ($res as &$value) {
      $value->rating_star = "";
      for ($i = 0; $i < $value->rating; $i++) {
        $value->rating_star .= "⭐";
      }

      $value->comment_color = $this->getCommentColor($value->comment_type);
      // $value->rateable_name = ($value->other_rateable_name && $value->name == 'Others') ? $value->rateable_name . " - " . $value->other_rateable_name : $value->rateable_name;
      $value->rateable_name = ($value->other_rateable_name) ? $value->rateable_name . " - " . $value->other_rateable_name : $value->rateable_name;
    }

    return $res;
  }

  function getTotalPages()
  {
    return ceil($this->buildQueryObjectAllFormatted()->num_rows() / $this->per_page);
  }

  public function get($id)
  { 
    $this->db->select("ratings.*, rateables.name,  IF(rateables.scope is NULL OR rateables.scope = '', 'internal/external', rateables.scope) as scope");
    $this->db->join('rateables', 'ratings.rateable_id = rateables.id', 'left');
    $this->db->where('ratings.id', $id);
    return $this->db->get('ratings')->row();
    
    // return $this->db->get_where('ratings', ['id' => $id])->row();
  }

  function getCommentColor($color_type)
  {
    switch ($color_type) {
      case 'compliment':
      return '#09ce09';
      break;

      case 'suggestion':
      default:
      return '#4f64f9';
      break;
    }
  }

  function countCommentType($rateable_id, $comment_type)
  {
    $this->db->where('rateable_id', $rateable_id);
    $this->db->where('comment_type', $comment_type);
    return $this->db->count_all_results('ratings');
  }

}
