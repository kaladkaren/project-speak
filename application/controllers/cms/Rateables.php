<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rateables extends Admin_core_controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('api/devices_model');
    $this->load->model('api/rateables_model');
    $this->load->model('api/stations_model');
    $this->load->model('api/divisions_model');

  }
 
  public function index($type)
  {
    $this->rateables_model->paginate();

    $name = $this->input->get('name');
    $sub_name = $this->input->get('sub_name');

    # seearch filter block
    $this->searchFilterBlock($name, $sub_name);
    # seearch filter block
    
    $data['res'] =  $this->rateables_model->allByType($type);

    $this->db->order_by('division_name', 'asc');
    $data['divisions'] =  $this->divisions_model->all();

    $data['type'] = ucwords($type);
    $data['type_lower'] = $type;

    $this->searchFilterBlock($name, $sub_name);
    $data['total_pages'] = $this->rateables_model->getTotalPages($type);

    switch ($type) {
      case 'experience':
        $data['name_header'] = 'Experience name';
        $data['sub_name_header'] = 'Experience subtitle';
        $data['description_header'] = 'Description';
        break;
      case 'services':
        $data['name_header'] = 'Service name';
        $data['sub_name_header'] = 'Service subtitle';
        $data['description_header'] = 'Description';
        break;
      
      default:
      case 'people':
        $data['name_header'] = 'Nickname';
        $data['sub_name_header'] = 'Full name';
        $data['description_header'] = 'Position';
        break; 
    }

    #pagination shits
    $data['page'] = $this->rateables_model->page;
    $data['name'] = $name;
    $data['sub_name'] = $sub_name;
    $data['per_page'] = $this->rateables_model->per_page;
    $data['starty'] = ($data['page'] == 1) ? 1 : (($data['page'] - 1) * $data['per_page']) + 1;

    $this->wrapper('cms/rateables', $data);
  }

  function searchFilterBlock($name, $sub_name)
  {
    $where_name = ($name) ? "rateables.name LIKE '%$name%'" : 1;
    $where_sub_name = ($sub_name) ? "rateables.sub_name LIKE '%$sub_name%'": 1;

    $this->db->where("$where_name AND $where_sub_name");
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

  public function delete()
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
