<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_agencies extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/sub_agencies_model');
    $this->load->model('api/departments_model');

  }
 
  public function index()
  {
    $data['res'] =  $this->sub_agencies_model->all();
    $data['departments'] =  $this->departments_model->all();
    $this->wrapper('cms/sub-agencies', $data);
  }

  public function add()
  {
    $data = $this->input->post();

    if($this->sub_agencies_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/sub-agencies');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->sub_agencies_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/sub-agencies');
  }

  public function delete($id)
  {
    if($this->sub_agencies_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/sub-agencies');
  }


 
  function assign()
  {
    $res = $this->sub_agencies_model->update(
      $this->input->post('id', true),
      ['department_id' => $this->input->post('department_id', true)]
    );

    if ($res) {
      http_response_code(200);
      echo json_encode(['status' => 'ok']);
    } else {
      http_response_code(400);
      echo json_encode(['status' => 'bad_request']);
    }

    return;
  }
 

}
