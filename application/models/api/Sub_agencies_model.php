<?php

class Sub_agencies_model extends Crud_model
{
  
  function __construct(){
  	parent::__construct();

    $this->per_page = $this->input->get('per_page') ?: 15;
    $this->page = $this->input->get('page') ?: 1;

  }

  public function add($data)
  {
    $this->db->insert('sub_agencies', $data);
    return $this->db->insert_id();
  }

  public function all()
  {
    $this->db->select('sub_agencies.*, departments.department_name');
    $this->db->join('departments', 'sub_agencies.department_id = departments.id');
    $this->db->order_by('sub_agencies.id', 'asc');
    $res = $this->db->get('sub_agencies')->result();
    return $res;
  }
 
  public function get($id)
  {
    return $this->db->get_where('sub_agencies', array('id' => $id))->row();
  }

  public function update($id, $data)
  {
    $this->db->update('sub_agencies', $data, ['id' => $id]);
    return $this->db->affected_rows(); # Returns 1 if update is successful, returns 0 if update is already made, but query is successful
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('sub_agencies');
    return $this->db->affected_rows();
  }
 
  public function allByDepartmentId($department_id)
  {
    return $this->db->get_where('sub_agencies', array('department_id' => $department_id))->result();
  }

  public function getTotalPages()
  {
    return ceil(count($this->db->get('sub_agencies')->result()) / $this->per_page);
  }

  public function paginate()
  {
    $offset = (($this->page - 1) * $this->per_page) ?: 0;
    $this->db->limit($this->per_page, $offset);
  }

}
