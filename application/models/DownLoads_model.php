<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DownLoads_model extends CI_Model {
    public function Day_count(){
        $sql="select product_ID,count(product_ID) as count ,date(times) as times from success
        GROUP BY product_ID,date(times) order by date(times) asc";
        $result =$this->db->query($sql)->result_array();
        return $result;
    }

}
