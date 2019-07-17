<?php

class Divisions_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

    $this->per_page = $this->input->get('per_page') ?: 15;
    $this->page = $this->input->get('page') ?: 1;
  }

  public function add($data)
  {
    $this->db->insert('divisions', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $res = $this->db->get('divisions')->result();
    return $res;
  }

  public function get($id)
  {
    return $this->db->get_where('divisions', array('id' => $id))->row();
  }
 
  public function update($id, $data)
  {
    $this->db->update('divisions', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('divisions');
    return $this->db->affected_rows();
  }

  public function getTotalPages()
  {
    return ceil(count($this->db->get('divisions')->result()) / $this->per_page);
  }

  public function paginate()
  {
    $offset = (($this->page - 1) * $this->per_page) ?: 0;
    $this->db->limit($this->per_page, $offset);
  }


}
