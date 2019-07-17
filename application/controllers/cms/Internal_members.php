<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Internal_members extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/internal_members_model');
    $this->load->model('api/divisions_model');

  }
 
  public function index()
  {
    $data['res'] =  $this->internal_members_model->all();
    $data['divisions'] =  $this->divisions_model->all();
    $this->wrapper('cms/internal-members', $data);
  }

  public function add()
  {
    $data = $this->input->post();

    if($this->internal_members_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/internal-members');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->internal_members_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/internal-members');
  }

  public function delete($id)
  {
    if($this->internal_members_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/internal-members');
  }


 
  function assign()
  {
    $res = $this->internal_members_model->update(
      $this->input->post('id', true),
      ['division_id' => $this->input->post('division_id', true)]
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
