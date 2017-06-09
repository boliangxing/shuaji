<?php $this->load->view('header');?>
  <div class="cl pd-5 bg-1 bk-gray mt-20">

    <div class="mt-20">
      <!-- 表单  -->
	    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <!-- 表单头部  -->
		    <thead>
			    <tr class="text-c">
			      <th width="40">产品id</th>
            <th width="40">当日刷量</th>
            <th width="40">日期</th>
			    </tr>
		    </thead>
        <!-- 表单内容  -->
		    <tbody>
			    <?php foreach($list as $row){ ?>
          <tr class="text-c">
            <td><?php echo $row['product_ID']; ?></td>
				    <td><?php echo $row['count']; ?></td>
				    <td><?php echo $row['times']; ?></td>
          </tr>
		      <?php }?>
 		    </tbody>

	    </table>

    </div>

  </div>
<?php $this->load->view('footer');?>
