<?php

class Options_model extends CI_Model
{
  
  function __construct(){
  	parent::__construct();
 
  }

  function buildOptionsGeneric($last_updated)
  {
    $options = [];
    foreach (['internal_members', 'divisions', 'departments', 'sub_agencies'] as $value) {
      $res = $this->db->get($value)->result();

      $options_obj = (object)[];
      $options_obj->type = $value;
      
      $is_updated = false;

      foreach ($res as $value) {
        if ($value->updated_at == '0000-00-00 00:00:00') {
          continue;
        }
        $is_updated = $is_updated || (strtotime($last_updated) < strtotime($value->updated_at));
      }

      $options_obj->is_updated = $is_updated;

      $options[] = $options_obj;
    }

    return $options;
  }

 

}
