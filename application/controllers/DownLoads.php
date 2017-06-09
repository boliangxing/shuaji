<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Downloads extends CI_Controller {
  public function index(){
      $this->load->helper('url');
      $this->load->model('DownLoads_model');
      $data['list']=$this->DownLoads_model->Day_count();
      $this->load->view('DownLoads/index',$data);
  }
}
