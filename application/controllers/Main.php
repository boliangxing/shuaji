<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
  public function index(){
 $this->load->view('main');
  }
  public function welcome(){
  $this->load->helper('url');
  $this->load->view('welcome');
  }
  public function test(){
$a = file_get_contents("http://121.41.90.45:3001/api2/sdownload.php");
$re = json_decode($a,true);
$this->load->model('Task_model');
$this->Task_model->insert_test($re['appleId'],$re['password'],$re['udid']);
var_dump($re);
$this->load->view('test');

  }
  }
