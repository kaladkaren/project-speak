<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/departments_model');

  }
 
  public function index()
  {
    $this->departments_model->paginate();
    $this->db->order_by('department_name', 'asc');
    $data['res'] =  $this->departments_model->all();

    #pagination shits
    $data['total_pages'] = $this->departments_model->getTotalPages();
    $data['page'] = $this->departments_model->page;
    $data['per_page'] = $this->departments_model->per_page;
    $data['starty'] = ($data['page'] == 1) ? 1 : (($data['page'] - 1) * $data['per_page']) + 1;

    $this->wrapper('cms/departments', $data);
  }

  public function add()
  {
    $data = $this->input->post();

    if($this->departments_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/departments');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->departments_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/departments');
  }

  public function delete()
  {
    if($this->departments_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/departments');
  }
 

}
