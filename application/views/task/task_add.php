<?php $this->load->view('header');?>
<form action="" method="post" class="form form-horizontal" id="form-customer-add">
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>product_ID:</label>
    <div class="formControls col-5">
      <input type="text" class="input-text" value="" placeholder="" name="product_ID" datatype="*" nullmsg="名称不能为空">
    </div>
    <div class="col-4"> </div>
  </div>

  <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>关键词:</label>
    <div class="formControls col-5">
      <input type="text" class="input-text" value="" placeholder="" name="keyword" datatype="*" nullmsg="名称不能为空">
    </div>
    <div class="col-4"> </div>
  </div>

  <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>目标数量</label>
    <div class="formControls col-5">
      <input type="text" class="input-text" value="" placeholder="" name="tocount" datatype="*" nullmsg="名称不能为空">
    </div>
    <div class="col-4"> </div>
  </div>

    <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>每轮刷量</label>
    <div class="formControls col-5">
      <input type="text" class="input-text" value="" placeholder="" name="round_num" datatype="*" nullmsg="名称不能为空">
    </div>
    <div class="col-4"> </div>
  </div>

  <div class="row cl">
    <div class="col-9 col-offset-3">
      <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
    </div>
  </div>

</form>
<?php $this->load->view('footer');?>
<script type="text/javascript">
$("#form-customer-add").Validform({
  tiptype:2,
  callback:function(form){
    var data = $("#form-customer-add").serialize();
      $.ajax({
        type: "POST",
        url: "",
        datatype : 'script',
        data:data,
        success: function(data){
          if(data == '添加成功'){
            layer.msg("成功",{icon: 6,time:2000});
              //location.href="";
          }else{
            layer.msg("失败",{icon: 5,time:1000});
          }
        },
        error: function () {
          layer.msg("系统错误，请稍后重试！",{icon: 5,time:1000});
        }
    });
  }
});


</script>
