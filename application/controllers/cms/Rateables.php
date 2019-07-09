<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rateables extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/rateables_model');

  }
 
  public function index($type)
  {
    $data['res'] =  $this->rateables_model->allByType($type);
    $data['type'] = ucwords($type);
    $this->wrapper('cms/rateables', $data);
  }

  public function add()
  {
    $data = $this->input->post();

    if($this->rateables_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/rateables');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->rateables_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/rateables');
  }

  public function delete($id)
  {
    if($this->rateables_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/rateables');
  }

}
