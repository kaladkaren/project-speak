<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisions extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/divisions_model');

  }
 
  public function index()
  {
    $data['res'] =  $this->divisions_model->all();;
    $this->wrapper('cms/divisions', $data);
  }

  public function add()
  {
    $data = $this->input->post();

    if($this->divisions_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/divisions');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->divisions_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/divisions');
  }

  public function delete($id)
  {
    if($this->divisions_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/divisions');
  }
 

}
