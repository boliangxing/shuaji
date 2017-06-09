<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daoru extends CI_Controller {
    public function udid_index(){
        $this->load->helper('url');
        if($this->input->post('xxxxx')){
            $this->load->library ( array( 'form_validation' ,'PHPExcel','PHPExcel/IOFactory'));
            $dateline=time();//导入的时间
            //////上传Excel
            $config ['upload_path'] = './public/';
            $config ['allowed_types'] = 'xls';
            $config ['max_size'] = '2000';
            $config ['file_name'] = date ( 'Ymdhis', time () );
            $this->load->library ( 'upload', $config );
            if (! $this->upload->do_upload ('files')) {
                $error = array ('error' => $this->upload->display_errors() );
                echo $error ['error'];
                echo '返回';
                exit ();
            }else {
                $data = array ('upload_data' => $this->upload->data() );
                $file_name = $data ['upload_data'] ['file_name'];
            }
            $uploadfile='./public/'.$file_name;//获取上传成功的Excel
            $objReader =IOFactory::createReader('Excel5');//use excel2007 for 2007 format
            $objPHPExcel = $objReader->load($uploadfile);//加载目标Excel
            $sheet = $objPHPExcel->getSheet(0);//读取第一个sheet
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $succ_result=$error_result=0;//设置导入成功和失败的总数为0
            /////////////////////////数据库操作
            $conn = mysqli_connect("localhost", "root", "root");  //or die("Could not connect : " . mysqli_error());
            mysqli_select_db($conn,"shuaji") or die("Could not select database");
            //mysqli_query("set names utf8");
            //入库
            for($j=2;$j<=$highestRow;$j++){
                $strExcel='';
                for($k='A';$k<= $highestColumn;$k++){
                //读取单元格
                $strExcel .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';
            }
            $strs=explode(",",$strExcel);
            //Excel前两列必填 （这是我自己设定的Excel导入模板 产品名称、价格是不能为空的 否则跳过）
            $sql="insert into udid(udid,status) values ('$strs[0]','0')";
            //mysql_query("set names utf8");
            $result=mysqli_query($conn,$sql) ;//or die("execute error");
            //$insert_num=mysql_affected_rows();
            }
            //弹出导入成功/失败条数的提示
            //$data['message']="插入成功".$succ_result."条数据！！！  插入失败".$error_result."条数据！！！ ";
            mysqli_close($conn);
            //unlink('./public/temp/'.$file_name);//删除临时Excel
            $this->load->view ( 'daoru/udid_index');
        }
        $this->load->view('daoru/udid_index');
   }

   public function appleid_index(){
       $this->load->helper('url');
       if($this->input->post('xxxxx')){
           //$this->load->helper ( array ('form', 'url', 'common' ) );
           $this->load->library ( array( 'form_validation' ,'PHPExcel','PHPExcel/IOFactory'));
           $dateline=time();//导入的时间
           //////上传Excel
           $config ['upload_path'] = './public/';
           $config ['allowed_types'] = 'xls';
           $config ['max_size'] = '2000';
           $config ['file_name'] = date ( 'Ymdhis', time () );
           $this->load->library ( 'upload', $config );
           if (! $this->upload->do_upload ('files')) {
               $error = array ('error' => $this->upload->display_errors() );
                echo $error ['error'];
                echo '返回';
                exit ();
           }else {
               $data = array ('upload_data' => $this->upload->data() );
               $file_name = $data ['upload_data'] ['file_name'];
           }
           $uploadfile='./public/'.$file_name;//获取上传成功的Excel
           $objReader =IOFactory::createReader('Excel5');//use excel2007 for 2007 format
           $objPHPExcel = $objReader->load($uploadfile);//加载目标Excel
           $sheet = $objPHPExcel->getSheet(0);//读取第一个sheet
           $highestRow = $sheet->getHighestRow(); // 取得总行数
           $highestColumn = $sheet->getHighestColumn(); // 取得总列数
           $succ_result=$error_result=0;//设置导入成功和失败的总数为0
           /////////////////////////数据库操作
           $conn = mysqli_connect("localhost", "root", "root");  //or die("Could not connect : " . mysqli_error());
           mysqli_select_db($conn,"shuaji") or die("Could not select database");
           //mysqli_query("set names utf8");
           //入库
           for($j=2;$j<=$highestRow;$j++){
               $strExcel='';
               for($k='A';$k<= $highestColumn;$k++){
                   //读取单元格
                   $strExcel .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';
               }
               $strs=explode(",",$strExcel);
               //Excel前两列必填 （这是我自己设定的Excel导入模板 产品名称、价格是不能为空的 否则跳过）
               $sql="insert into appleid(appleid,applepwd,status) values ('$strs[0]','$strs[1]','0')";
               //mysql_query("set names utf8");
               $result=mysqli_query($conn,$sql) ;//or die("execute error");
               //$insert_num=mysql_affected_rows();
           }
           //弹出导入成功/失败条数的提示
           //$data['message']="插入成功".$succ_result."条数据！！！  插入失败".$error_result."条数据！！！ ";
           mysqli_close($conn);
           //unlink('./public/temp/'.$file_name);//删除临时Excel
           $this->load->view ( 'daoru/appleid_index');
     }
     $this->load->view('daoru/appleid_index');
  }
  public function vpn_index(){
      $this->load->helper('url');
      if($this->input->post('xxxxx')){
          //$this->load->helper ( array ('form', 'url', 'common' ) );
          $this->load->library ( array( 'form_validation' ,'PHPExcel','PHPExcel/IOFactory'));
          $dateline=time();//导入的时间
          //////上传Excel
          $config ['upload_path'] = './public/';
          $config ['allowed_types'] = 'xls';
          $config ['max_size'] = '2000';
          $config ['file_name'] = date ( 'Ymdhis', time () );
          $this->load->library ( 'upload', $config );
          if (! $this->upload->do_upload ('files')) {
              $error = array ('error' => $this->upload->display_errors() );
              echo $error ['error'];
              echo '返回';
              exit ();
          }else {
              $data = array ('upload_data' => $this->upload->data() );
              $file_name = $data ['upload_data'] ['file_name'];
          }
          $uploadfile='./public/'.$file_name;//获取上传成功的Excel
          $objReader =IOFactory::createReader('Excel5');//use excel2007 for 2007 format
          $objPHPExcel = $objReader->load($uploadfile);//加载目标Excel
          $sheet = $objPHPExcel->getSheet(0);//读取第一个sheet
          $highestRow = $sheet->getHighestRow(); // 取得总行数
          $highestColumn = $sheet->getHighestColumn(); // 取得总列数
          $succ_result=$error_result=0;//设置导入成功和失败的总数为0
          /////////////////////////数据库操作
          $conn = mysqli_connect("localhost", "root", "root");  //or die("Could not connect : " . mysqli_error());
          mysqli_select_db($conn,"shuaji") or die("Could not select database");
          //mysqli_query("set names utf8");
          //入库
          for($j=2;$j<=$highestRow;$j++){
              $strExcel='';
              for($k='A';$k<= $highestColumn;$k++){
                  //读取单元格
                  $strExcel .= $objPHPExcel->getActiveSheet()->getCell("$k$j")->getValue().',';
              }
              $strs=explode(",",$strExcel);
              //Excel前两列必填 （这是我自己设定的Excel导入模板 产品名称、价格是不能为空的 否则跳过）
              $sql="insert into vpn(vid,vpwd,status) values ('$strs[0]','$strs[1]','0')";
              //mysql_query("set names utf8");
              $result=mysqli_query($conn,$sql) ;//or die("execute error");
              //$insert_num=mysql_affected_rows();
          }
          //弹出导入成功/失败条数的提示
          //$data['message']="插入成功".$succ_result."条数据！！！  插入失败".$error_result."条数据！！！ ";
          mysqli_close($conn);
          //unlink('./public/temp/'.$file_name);//删除临时Excel
          $this->load->view ( 'daoru/vpn_index');
      }
      $this->load->view('daoru/vpn_index');
  }

           }
