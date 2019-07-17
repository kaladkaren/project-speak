<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rateables extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/rateables_model');
    $this->load->model('api/stations_model');

  }
 
  public function index($type)
  {
    $this->rateables_model->paginate();
    $data['res'] =  $this->rateables_model->allByType($type);
    $data['type'] = ucwords($type);
    $data['type_lower'] = $type;
    $data['total_pages'] = $this->rateables_model->getTotalPages($type);

    #pagination shits
    $data['page'] = $this->rateables_model->page;
    $data['per_page'] = $this->rateables_model->per_page;
    $data['starty'] = ($data['page'] == 1) ? 1 : (($data['page'] - 1) * $data['per_page']) + 1;

    $this->wrapper('cms/rateables', $data);
  }

  function stations()
  {
    $data['stations'] = $this->stations_model->getAllStationRateablesObjects();
    $data['flash_msg'] = $this->session->flash_msg;
    // var_dump($data['stations']); die();
    $this->wrapper('cms/rateables_stations', $data);
  }

  public function add()
  {
    $type = $this->input->post('type');
    $data = array_merge($this->input->post(), $this->rateables_model->upload('image_file'));

    if($this->rateables_model->add($data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item added successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error adding item', 'color' => 'red']);
    }

    $this->admin_redirect("cms/rateables/$type");
  }

  public function update($id)
  {
    $type = $this->input->post('type');
    $file = $this->rateables_model->upload('image_file');
    if (count($file) > 0) {
      $data = array_merge($this->input->post(), $file);
      $this->rateables_model->deleteUploadedMedia($id);
    } else {
      $data = $this->input->post();
    }

    if($this->rateables_model->update($id, $data)){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item updated successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Error updating item', 'color' => 'red']);
    }

    $this->admin_redirect("cms/rateables/$type");
  }

  function update_rateables_stations()
  {
    if($this->rateables_model->updateRateables($this->input->post())){
      $this->session->set_flashdata("flash_msg", ['message' => 'Updated data successfully', 'color' => 'green', 'station_id' => $this->input->post('id')]);
    } else {
      $this->session->set_flashdata("flash_msg", ['message' => 'Error updating data', 'color' => 'red', 'station_id' => $this->input->post('id')]);
    }

    $this->admin_redirect("cms/rateables/stations");
  }

  public function delete($id)
  {
    $type = $this->input->post('type');
    if($this->rateables_model->delete($this->input->post('id'))){
      $this->session->set_flashdata('flash_msg', ['message' => 'Item deleted successfully', 'color' => 'green']);
    } else {
      $this->session->set_flashdata('flash_msg', ['message' => 'Cannot delete item. There is already an existing rating for it.', 'color' => 'red']);
    }

    $this->admin_redirect("cms/rateables/$type");
  }

}
