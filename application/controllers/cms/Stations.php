<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/stations_model');

  }
 
  public function index()
  {
    $this->db->order_by('station_name', 'asc');
    $data['res'] =  $this->stations_model->all();
    $this->wrapper('cms/stations', $data);
  }

  public function add()
  {
    $data = $this->input->post();

    if($this->stations_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/stations');
  }

  public function update($id)
  {
    $data = $this->input->post();

    if($this->stations_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/stations');
  }

  public function delete($id)
  {
    if($this->stations_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error deleting item', 'color' => 'red']);
    }

    $this->admin_redirect('cms/stations');
  }


 
  function assign()
  {
    $res = $this->devices_model->update(
      $this->input->post('id', true),
      ['station_id' => $this->input->post('station_id', true)]
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
