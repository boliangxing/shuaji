<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_model extends CI_Model {
    public function insert_test($appleid,$password,$udid){
        $sql="insert into test(appleid,password,udid) values('$appleid','$password','$udid')";
        $result =$this->db->query($sql);
        return $result;
    }

    public function task_status($id,$status){
      if($status==0){
        $sql="update  task set status=1 where id='$id'";
      }else{
        $sql="update  task set status=0 where id='$id'";
      }

        $result =$this->db->query($sql);
        return $result;
    }

    public function task_del($id){
        $sql="delete from task where id='$id'";
        $result =$this->db->query($sql);
        return $result;
    }

    public function selectonekey($keysql){
			  $sql="select t1.id, t1.product_ID,t1.keyword,t2.bundle_id  from task as t1,app as t2   ";
			  $sql.="where  $keysql and t1.product_ID=t2.product_ID and t1.count < t1.tocount  group by t1.product_ID ";
			    
  		  $result =$this->db->query($sql)->result_array();
  		  return $result;
		}

    public function selectudid($product_ID){
        $sql="SELECT udid FROM udid WHERE  status!=1 and udid not in (select udid from success where product_ID='$product_ID') order by udid limit 1";
  	    $result =$this->db->query($sql)->result_array();
  	    $sql2="update udid set status=1 where status!=1 order by udid desc  limit 1";
  	    $r2 =$this->db->query($sql2);
  	    return $result;
    }

	  public function select(){
		    $sql="select * from task";
		    $result =$this->db->query($sql)->result_array();
		    return $result;
	  }

    public function insert_task($product_ID,$key,$tocount,$round_num){
			$sql="insert into task(product_ID,keyword,tocount,count,round_num) values('$product_ID','$key','$tocount',0,'$round_num')";
			$result =$this->db->query($sql);
			return $result;

		}

	  public function selectone(){
		    $sql="select id,product_ID,keyword from task where count<tocount and status!=1 order by  round_count asc limit 1";
		    $result =$this->db->query($sql)->result_array();
		    return $result;
	  }

	  public function selectagin($id){
		    $sql="select id,product_ID,keyword from task where id='$id' and status!=1 limit 1";
		    $result =$this->db->query($sql)->result_array();
		    return $result;
	  }

  	public function selectappleone($product_ID){
	      $sql="SELECT appleid.appleid,appleid.applepwd  FROM appleid LEFT JOIN success ON appleid.appleid=success.appleid
        WHERE (success.product_ID !=$product_ID
        and appleid.status!=1) or  (success.product_ID is null and appleid.status!=1 )
        order by appleid limit 1";
	      $result =$this->db->query($sql)->result_array();
        if(!empty($result)){
            $appn=$result[0]['appleid'] ;
            $sql2="update appleid set status=1 where appleid='$appn' ";
            $r2 =$this->db->query($sql2);
        }
	      return $result;
	  }

		public function selectvpnone($product_ID){
		    $sql="SELECT vpn.vid,vpn.vpwd FROM vpn LEFT JOIN success ON vpn.vid=success.vid WHERE (success.product_ID !=$product_ID
        and vpn.status!=1)or  (success.product_ID is null and vpn.status!=1 )
        order by vid limit 1";
        $result =$this->db->query($sql)->result_array();
        if(!empty($result)){
            $v=$result[0]['vid'];
            $sql2="update vpn set status=1 where   vid='$v' ";
            $r2 =$this->db->query($sql2);
        }
		    return $result;
		}

		public function selectapple($applename){
	      $sql="SELECT appleid,applepwd FROM appleid WHERE  status!=1 and appleid!='$applename'  order by appleid limit 1";
	 	    $result =$this->db->query($sql)->result_array();
		    $sql2="update appleid set status=1 where status!=1 and appleid!='$applename' order by appleid desc  limit 1";
        $r2 =$this->db->query($sql2);
		    return $result;
	  }

		public function selectvpn($vid){
		    $sql="SELECT vid,vpwd FROM vpn WHERE  status!=1  and vid!='$vid' order by vid desc  limit 1";
		    $result =$this->db->query($sql)->result_array();
        $sql3="update vpn set status=0 where  vid='$vid'  order by vid desc  limit 1";
        $this->db->query($sql3);
        $sql2="update vpn set status=1 where status!=1 and vid!='$vid'  order by vid desc  limit 1";
        $r2 =$this->db->query($sql2);
		    return $result;
		}

	  public function selecttime($id){
		    $sql="SELECT id,product_ID,keyword  FROM task WHERE  id!=$id and status!=1 limit 1";
		    $result =$this->db->query($sql)->result_array();
		    return $result;
		}

		public function selectappid($product_ID){
		    $sql="SELECT id,product_ID,keyword FROM task WHERE  product_ID!='$product_ID' and status!=1   limit 1";
	      $result =$this->db->query($sql)->result_array();
		    return $result;
	  }

	 public function returnsuccess($id,$vid,$appleid,$udid){
	     $sql="update  vpn set status=0  where vid='$vid'";
	     $this->db->query($sql);
       $sql1="update  appleid set status=0  where appleid='$appleid'";
	     $this->db->query($sql1);
       $sql2="update  udid set status=0  where udid='$udid'";
       $this->db->query($sql2);
       $sqlx="select product_ID from task where id='$id'  and status!=1 ";
       $x= $this->db->query($sqlx)->result_array();
       $product_ID=$x[0]['product_ID'];
       $sql3="insert into success(product_ID,udid,vid,appleid,times) values('$product_ID','$udid','$vid','$appleid',now())";
       $this->db->query($sql3);
	     $sqls="select count(*) from task where id='$id' and count>=tocount and  status!=1 ";
	     $rs=$this->db->query($sqls)->result_array();
	     if($rs[0]==1){
		       return $rs;
	     }else{
           $sql2="update task set count=count+1 ,round_count=floor(count/round_num) where id='$id' ";
	         $r2 =$this->db->query($sql2);
	         return $r2;
       }
	 }

}
