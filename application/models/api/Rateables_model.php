<?php

class Rateables_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

    $this->upload_dir = 'rateables'; # uploads/your_dir
    $this->uploads_folder = "uploads/" . $this->upload_dir . "/";
    $this->full_up_path = base_url() . "uploads/" . $this->upload_dir . "/"; # override this block on your child class. just redeclare it
    $this->per_page = $this->input->get('per_page') ?: 15;
    $this->page = $this->input->get('page') ?: 1;
  }

  public function add($data)
  {
    $this->db->insert('rateables', $data);
    return $this->db->insert_id();
  }

  public function allByType($type)
  {
    $this->db->order_by('rateables.name', 'asc');
    $this->db->select('rateables.*, divisions.division_name');
    $this->db->where('rateables.type', $type);
    $this->db->join('divisions', 'rateables.division_id = divisions.id', 'left');
    $res = $this->db->get('rateables')->result();

    $res = $this->formatRateables($res);

    return $res;
  }

  function getRateables($station_id)
  {
    return $this->db->query("SELECT rateables.id as id, rateables.name, rateables.type FROM `rateables`
      LEFT JOIN stations_rateables ON rateables.id = stations_rateables.rateable_id
      WHERE station_id = {$station_id}")->result();
  }

 function allServicesByScope($station_id, $scope = null)
 {
    # Get from 3rd table first 
    $stations_rateables = $this->db->get_where('stations_rateables', ['station_id' => $station_id])->result_array();

    $ids_arr = array_column($stations_rateables, 'rateable_id');

    # Get from rateables table with filters
    $this->db->order_by('name', 'asc');
    $this->db->select('rateables.*, if(divisions.division_name is null, "Unclassified", divisions.division_name) as division_name');
    $this->db->where('rateables.type', 'services');
    $this->db->where_in('rateables.id', $ids_arr);
    if ($scope == null) {
      $this->db->where('(scope = "" OR scope IS NULL)'); # for empty string
    } else {
      $this->db->where("(scope = '$scope' OR scope IS NULL OR scope = '')");
    }
    $this->db->join('divisions', 'rateables.division_id = divisions.id', 'left');
    $res = $this->db->get('rateables')->result();

    $res = $this->formatRateables($res);
    
    return $res;
 }

 function moveOthersAtTheEnd($arr)
 {
   $new_arr = [];

   foreach ($arr as $value) {
     if($value->name != 'Others'){
      $new_arr[] = $value;

     }
   }

   foreach ($arr as $value) {
     if($value->name == 'Others'){
      $new_arr[] = $value;
     }
   }

   return $new_arr; 
 }

 function orderExperienceArray($arr){
  $rate_this_app = null;
  $overall_experience = null;

   foreach ($arr as $key => $value) {
     if($value->name == 'Rate this App'){
      $rate_this_app = $value;

      unset($arr[$key]);
     }

     if($value->name == 'Overall Experience'){
      $overall_experience = $value;

      unset($arr[$key]);
     }
   }

   if ($overall_experience) {
     array_unshift($arr, $overall_experience);
   }
   if ($rate_this_app) {
     array_push($arr, $rate_this_app);
   }
   
   return $arr;
 }

 function orderPeopleArray($arr){
  $head = null;

   foreach ($arr as $key => $value) {
     if(in_array($value->id, [65, 66])){
      $temp = $value;
      unset($arr[$key]);

      array_unshift($arr, $temp);

     }
   }
   
   return $arr;
 }

  function formatRateables($res)
  {
    foreach ($res as &$value) {
      $value->image_url = (strpos($value->image_file, 'robohash') !== false) ? $value->image_file : 
        $this->full_up_path . $value->image_file;
      $value->image_url = ($this->full_up_path == $value->image_url) ? 'https://via.placeholder.com/150?text=No+Image' : $value->image_url;
    }

    return $res;
  }

  public function getTotalPages($type = null)
  {
    if ($type) {
      $this->db->where('type', $type);
    }
    return ceil(count($this->db->get('rateables')->result()) / $this->per_page);
  }

  /**
  * this is for pagination
  * uses $this->input->get('page') and $this->input->get('per_page')
  * @return [type] [description]
  */
  public function paginate()
  {
    $offset = (($this->page - 1) * $this->per_page) ?: 0;
    $this->db->limit($this->per_page, $offset);
  }

  public function get($id)
  {
    $this->db->select('rateables.*, divisions.division_name');
    $this->db->join('divisions', 'rateables.division_id = divisions.id', 'left');
    return $this->db->get_where('rateables', array('rateables.id' => $id))->row();
  }

  function updateRateables($data)
  {
    $station_id = $data['id'];
    $rateable_ids = $data['rateable_ids'];
    $rateables_existing_ids = $this->getExistingRateables($station_id);

    # if resubmitting and same shit
    if ($rateable_ids == $rateables_existing_ids) {
      return true;  
    }

    $this->db->where('station_id', $station_id);
    $this->db->delete('stations_rateables');
    $this->db->reset_query();

    if (!$rateable_ids) {
      return true;
    } else {
      $batch_data = [];
      foreach ($rateable_ids as $value) {
        $batch_data[] = ['station_id' => $station_id, 'rateable_id' => $value];
      }
      return $this->db->insert_batch('stations_rateables', $batch_data); 
    }
  }

  function getExistingRateables($station_id)
  {
    $this->db->where('station_id', $station_id);
    return array_column($this->db->get('stations_rateables')->result_array(), 'rateable_id');
  }


  function allByTypeAndStation($type, $station_id)
  {
    # Get from 3rd table first 
    $stations_rateables = $this->db->get_where('stations_rateables', ['station_id' => $station_id])->result_array();

    $ids_arr = array_column($stations_rateables, 'rateable_id');

    # Get from rateables table with filters
    $this->db->order_by('rateables.name', 'asc');
    $this->db->select('rateables.*, if(divisions.division_name is null, "Unclassified", divisions.division_name) as division_name');
    $this->db->where('rateables.type', $type);
    $this->db->where_in('rateables.id', $ids_arr);
    $this->db->join('divisions', 'rateables.division_id = divisions.id', 'left');
    $res = $this->db->get('rateables')->result();

    $res = $this->formatRateables($res);
    
    return $res;
  }

  public function deleteUploadedMedia($id)
  {
    $this->db->where('id', $id);
    $path = $this->uploads_folder . $this->db->get('rateables')->row()->image_file;

    $file_deleted = false;

    try {
      @unlink($path);
      $file_deleted =  true;
    } catch (\Exception $e) {
      $file_deleted = false;
    }

    return $file_deleted;
  }

  public function delete($id)
  {
    if ($this->checkRatingExists($id)) {
      return false;
    }

    $this->deleteFromStationsRateables($id);
    $this->deleteUploadedMedia($id);
    $this->db->reset_query();
    $this->db->where('id', $id);
    return $this->db->delete('rateables');
  }

  function checkRatingExists($id)
  {
    $this->db->where('rateable_id', $id);
    return $this->db->count_all_results('ratings');
  }

  function deleteFromStationsRateables($rateable_id)
  {
    $this->db->reset_query();
    $this->db->where('rateable_id', $rateable_id);
    return $this->db->delete('stations_rateables');
  }


  public function upload($file_key)
  {
    @$file = $_FILES[$file_key];
    $upload_path = $this->uploads_folder;

    $config['upload_path'] = $upload_path; # NOTE: Change your directory as needed
    $config['allowed_types'] = 'jpg|jpeg|png'; # NOTE: Change file types as needed
    $config['file_name'] = time() . '_' . $file['name']; # Set the new filename
    $this->upload->initialize($config);

    if (!is_dir($upload_path) && !mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true)){
      mkdir($upload_path, DEFAULT_FOLDER_PERMISSIONS, true); # You can set DEFAULT_FOLDER_PERMISSIONS constant in application/config/constants.php
    }
    if($this->upload->do_upload($file_key)){
      return [$file_key => $this->upload->data('file_name')];
    }else{
      return [];
    }
  }

  public function update($id, $data)
  {
    if ($this->get($id) === [])
    return null; # Return null if entry is not existing

    $this->db->update('rateables', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  function buildOptionsRateables($station_id, $last_updated)
  {
    $rateables = [];
    foreach (['services', 'experience', 'people'] as $value) {
      $this->db->select('stations_rateables.station_id, rateables.type, rateables.updated_at');
      $this->db->join('rateables', 'stations_rateables.rateable_id = rateables.id', 'left');
      $this->db->where('station_id', $station_id);
      $this->db->where('type', $value);
      $res = $this->db->get('stations_rateables')->result();

      $rateables_obj = (object)[];
      $rateables_obj->type = $value;
      
      $is_updated = false;

      foreach ($res as $value) {
        if ($value->updated_at == '0000-00-00 00:00:00') {
          continue;
        }
        $is_updated = $is_updated || (strtotime($last_updated) < strtotime($value->updated_at));
      }

      $rateables_obj->is_updated = $is_updated;

      $rateables[] = $rateables_obj;
    }

    return $rateables;
  }

  function checkIfReassigned($station_id, $last_updated){
    $this->db->distinct();
    $this->db->select('created_at');
    $this->db->where('station_id', $station_id);
    $created_at = @$this->db->get('stations_rateables')->row()->created_at;

    if (!$created_at) {
      return false; # if empty
    }

    return strtotime($last_updated) < strtotime($created_at); # if created at is greater, it means list is updated
  }

}