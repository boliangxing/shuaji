<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

  public function index(){
  $this->load->helper('url');
  $this->load->model('Task_model');
  $data['list']=$this->Task_model->select();
  $this->load->view('task/index',$data);
  }

  public function task_add(){
  $this->load->helper('url');
  $product_ID=$this->input->post('product_ID');
  if($product_ID!=''){
      $key=$this->input->post('keyword');
      $tocount=$this->input->post('tocount');
      $round_num=$this->input->post('round_num');
      $this->load->model('Task_model');
      $data=$this->Task_model->insert_task($product_ID,$key,$tocount,$round_num);
      if($data){
          $data='添加成功';
          return $data;
      }
  }else{
      $this->load->view('task/task_add');
  }
  }

  public function welcome(){
  $this->load->helper('url');
  $this->load->view('welcome');
}

  public function Api(){
  $errorcode=$this->input->post("errorcode");
  if($errorcode!=""){
      //0为成功 1为请求超时 2为appid错误 3为vpn错误 4为apple帐号错误
      if($errorcode==1){
      $id=$this->input->post("id");
      $this->load->model('Task_model');
      for($i=0;$i<count($id);$i++){
      if($i==0){
          $ids= $id[$i];
      }else{
          $ids.=' and  id!= '.$id[$i];
      }
      }
      $data['downloads'][]=$this->Task_model->selecttime($ids);
      echo json_encode($data);
      }else if($errorcode==2){
      $product_ID=$this->input->post("Product_id");
      $this->load->model('Task_model');
      $data=$this->Task_model->selectappid($product_ID);
      echo json_encode($data);
      }else if($errorcode==3){
      $id=$this->input->post("id");
      $vid=$this->input->post("vid");
      $this->load->model('Task_model');
      $vpn=$this->Task_model->selectvpn($vid);
      $task=array();
      for ($i=0; $i < count($id) ; $i++) {
          # code...
          $task[$i]=$this->Task_model->selectagin($id);
      }
      $data['vid']=$vpn[0]['vid'];
      $data['vpwd']=$vpn[0]['vpwd'];
      $data['downloads']=$task;
      if(empty($vpn)){
          $data=array("error"=>'251');
      }
      echo json_encode($data);
      }else if($errorcode==4){
      $applename=$this->input->post("appleid");
      $id=$this->input->post("id");
      $this->load->model('Task_model');
      $apple=$this->Task_model->selectapple($applename);
      $task=array();
      for ($i=0; $i < count($id) ; $i++) {
          # code...
          $task[$i]=$this->Task_model->selectagin($id[$i]);
      }
      if(empty($apple)){
          $data=array("error"=>'252');
            echo json_encode($data);die;
      }
      $data['appleid']=$apple[0]['appleid'];
      $data['password']=$apple[0]['applepwd'];
      $data['downloads']=$task;

      echo json_encode($data);
      }else if ($errorcode==0){
      $id=$this->input->post("id");
      $vid=$this->input->post("vid");
      $appleid=$this->input->post("appleid");
      $udid=$this->input->post("udid");
      $this->load->model('Task_model');
      for ($i=0; $i < count($id) ; $i++) {
          # code...
          $data=$this->Task_model->returnsuccess($id[$i],$vid,$appleid,$udid);
      }
      if($data!=""){
          $json=array('success'=>'0');
          echo json_encode($json);
      }
      }
  }else{
  $this->load->model('Task_model');
  $data=$this->Task_model->selectone();
  $key = explode(',',$data[0]['keyword']);

  for($index=0;$index<count($key);$index++){
             if($index==0){
             $keysql= 'find_in_set("'.$key[$index].'", t1.keyword)';
      }else{
          $keysql.=' or find_in_set("'.$key[$index].'", t1.keyword)';
      }
        
  } 
   $orappid=$this->Task_model->selectonekey($keysql);
   

  if($orappid!=''){
      for($i=0;$i<count($orappid);$i++){
      if($i==0){
     
          $product_ID= $orappid[$i]['product_ID'];
      }else{
          $product_ID.=' and  success.product_ID!= '.$orappid[$i]['product_ID'];
      }
  }
  $udid=$this->Task_model->selectudid($product_ID);
  $apple=$this->Task_model->selectappleone($product_ID);
  $vpn=$this->Task_model->selectvpnone($product_ID);
  if($apple[0]['appleid']==''||$udid[0]['udid']==''||$vpn[0]['vid']==''){
      $json=array("error"=>'250');
      echo json_encode($json);die;
  }
  $json=array(
      "appleId"=>$apple[0]['appleid'],
      "password"=>$apple[0]['applepwd'],
      "udid"=>$udid[0]['udid'],
      "vid"=>$vpn[0]['vid'],
      "vpwd"=>$vpn[0]['vpwd'],
      "downloads"=>$orappid
  );
  echo json_encode($json);
  // }else{
  // $product_ID=' product_ID!='.$data[0]['product_ID'];
  // $apple=$this->Task_model->selectappleone($product_ID);
  // $vpn=$this->Task_model->selectvpnone($product_ID);
  // if(empty($apple)||empty($vpn)||empty($uid)){
  //     $json=array("error"=>'250');
  // }
  // $json=array(
  //     "appleId"=>$apple[0]['appleid'],
  //     "password"=>$apple[0]['applepwd'],
  //     "udid"=>$udid[0]['udid'],
  //     "vid"=>$vpn[0]['vid'],
  //     "vpwd"=>$vpn[0]['vpwd'],
  //     "downloads"=>$data
  // );
  // echo json_encode($json);
  // }
  }
  }}

  public function task_del(){
      $id=$this->input->post('id');
      if($id!=''){
      $this->load->model('Task_model');
      $data=$this->Task_model->task_del($id);
      $json=array("status"=>1);
      echo json_encode($json);
      }
  }
  public function task_status(){
      $id=$this->input->post('id');
      $status=$this->input->post('status');
      if($id!=''){
      $this->load->model('Task_model');
      $data=$this->Task_model->task_status($id,$status);
      $json=array("status"=>1);
      echo json_encode($json);
  }}
 
  }
