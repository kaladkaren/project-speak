<?php

class Rateables_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

    $this->upload_dir = 'rateables'; # uploads/your_dir
    $this->uploads_folder = "uploads/" . $this->upload_dir . "/";
    $this->full_up_path = base_url() . "uploads/" . $this->upload_dir . "/"; # override this block on your child class. just redeclare it
  }

  public function add($data)
  {
    $this->db->insert('rateables', $data);
    return $this->db->insert_id();
  }

  public function allByType($type)
  {
    $this->db->where('type', $type);
    $res = $this->db->get('rateables')->result();

    foreach ($res as &$value) {
      $value->image_url = (strpos($value->image_file, 'robohash') !== false) ? $value->image_file : 
        $this->full_up_path . $value->image_file;
    }

    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('rateables', array('id' => $id))->row();
  }


  function allByTypeAndStation($type, $station_id)
  {
    # Get from 3rd table first 
    $stations_rateables = $this->db->get_where('stations_rateables', ['station_id' => $station_id])->result_array();

    $ids_arr = array_column($stations_rateables, 'rateable_id');

    # Get from rateables table with filters
    $this->db->where('type', $type);
    $this->db->where_in('id', $ids_arr);
    $res = $this->db->get('rateables')->result();

    foreach ($res as &$value) {
      $value->image_url = (strpos($value->image_file, 'robohash') !== false) ? $value->image_file : 
        $this->full_up_path . $value->image_file;
    }
    
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

}