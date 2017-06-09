<?php $this->load->view('header');?>
  <div class="cl pd-5 bg-1 bk-gray mt-20">

		 <a href="javascript:;" onclick="task_add('添加类别','<?php echo site_url('task/task_add') ?>','','510')" class="btn btn-primary radius">
		   <i class="Hui-iconfont">&#xe600;</i>
		   <span>添加任务</span>
		 </a>

	   <div class="mt-20">
	     <table class="table table-border table-bordered table-hover table-bg table-sort">
		     <thead>
		      <tr class="text-c">
				     <th width="80">序号</th>
				     <th width="40">产品id</th>
				     <th width="90">关键词</th>
             <th width="40">本次刷量</th>
             <th width="40">目前刷量</th>
             <th width="40">每轮刷量</th>
             <th width="40">状态</th>
             <th width="40">操作</th>
			     </tr>
		     </thead>
		     <tbody>
			     <?php foreach($list as $row){ ?>
           <tr class="text-c">
             <td><?php echo $row['id']; ?></td>
             <td><?php echo $row['product_ID']; ?></td>
             <td><?php echo $row['keyword']; ?></td>
				     <td><?php echo $row['tocount']; ?></td>
				     <td><?php echo $row['count']; ?></td>
             <td><?php echo $row['round_num']; ?></td>
             <td >
               <?php if ($row['status']==1) {?><span class="label label-defaunt radius">关闭中</span>
               <?php }else{?>
               <span class="label label-success radius">正常运行</span>
               <?php }?>
             </td>
		         <td>
						   <a title="删除" href="javascript:;" class="ml-5"
						     onclick="task_del('<?php echo $row['product_ID'] ?>','<?php echo $row['id'] ?>')"
						     style="text-decoration:none">
						   <i class="Hui-iconfont">&#xe6e2;</i>
							 </a>
               <a style="text-decoration:none"
                  onclick="task_status('<?php echo $row['product_ID'] ?>','<?php echo $row['id'] ?>','<?php echo $row['status'] ?>')"
                  href="javascript:;" title="更改状态">
               <i class="Hui-iconfont"></i></a>
             </td>
					 </tr>
		       <?php }?>
 		     </tbody>
	     </table>
	   </div>

  </div>
<?php $this->load->view('footer');?>

<script type="text/javascript">
function task_add(title,url){
  var index = layer.open({
			type: 2,
			title: title,
			content: url
	});
	layer.full(index);
}

function task_del(name,id){
  layer.confirm('确认要更改【'+name+'】吗？',function(index){
	  $.ajax({
		  type:'post',
		  url:'<?php echo site_url('task/task_del') ?>',
		  dataType:'json',
		  data:{
	    id:id
		  },
		  success:function(data){
		    if(data==null){
		      layer.msg('服务器端错误',{icon:2,time:2000});
		      return;
		    }
		    if(data.status!=1){
		      layer.msg(data.message,{icon:2,time:2000});
		      return;
		    }
		    layer.msg(data.message,{icon:1,time:2000});
		    location.replace(location.href);
		  },
		  error:function(xhr,status,error){
		  //layer.msg('删除成功',{icon:2,time:2000});
		  location.replace(location.href);
		  },
		  beforeSend:function(xhr){
		    layer.load(0,{shade:false});
		  },
	  });
	  return false;
  });
}

function task_status(name,id,status){
  layer.confirm('确认要关闭【'+name+'】吗？',function(index){
	  $.ajax({
		  type:'post',
		  url:'<?php echo site_url('task/task_status') ?>',
		  dataType:'json',
		  data:{
	    id:id,
      status:status
		  },
		  success:function(data){
		    if(data==null){
		      layer.msg('服务器端错误',{icon:2,time:2000});
		      return;
		    }
		    if(data.status!=1){
		      layer.msg(data.message,{icon:2,time:2000});
		      return;
		    }
		    layer.msg(data.message,{icon:1,time:2000});
		    location.replace(location.href);
		  },
		  error:function(xhr,status,error){
		  //layer.msg('删除成功',{icon:2,time:2000});
		  location.replace(location.href);
		  },
		  beforeSend:function(xhr){
		    layer.load(0,{shade:false});
		  },
	  });
	  return false;
  });
}

</script>
