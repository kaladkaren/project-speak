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

  public function get($id)
  {
    return $this->db->get_where('ratings', array('id' => $id))->row();
  }

}
