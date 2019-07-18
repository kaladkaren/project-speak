<?php

class Internal_members_model extends Crud_model
{
  
  function __construct(){
    parent::__construct();

    $this->per_page = $this->input->get('per_page') ?: 15;
    $this->page = $this->input->get('page') ?: 1;
  }

  public function add($data)
  {
    $this->db->insert('internal_members', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $this->db->select('internal_members.*, divisions.division_name');
    $this->db->join('divisions', 'internal_members.division_id = divisions.id');
    $res = $this->db->get('internal_members')->result();
    return $res;
  }
 
  public function get($id)
  {
    return $this->db->get_where('internal_members', array('id' => $id))->row();
  }

  public function update($id, $data)
  {
    $this->db->update('internal_members', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('internal_members');
    return $this->db->affected_rows();
  }

  public function getTotalPages()
  {
    return ceil(count($this->db->get('internal_members')->result()) / $this->per_page);
  }

  public function paginate()
  {
    $offset = (($this->page - 1) * $this->per_page) ?: 0;
    $this->db->limit($this->per_page, $offset);
  }
 

}
