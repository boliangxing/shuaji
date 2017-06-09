<?php $this->load->view('header');?>

<form action="" method="post" class="form form-horizontal" id="form-customer-add" enctype="multipart/form-data">

  <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>请上传excel:</label>
    <div class="formControls col-5">
      <input type="file" name="files" id='files' ullmsg="名称不能为空">
      <input type="hidden" name="xxxxx" datatype="*"value="da" nullmsg="名称不能为空">
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
