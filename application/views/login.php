<?php $this->load->view('header');?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/style2.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/animate-custom.css" />
<body style="background:url('<?php echo base_url()?>public/images/bgbg.jpg')
;">
<div style="height:200px"></div>

                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action=""  class="from" method="post" onsubmit="return false;">
                                <h1>Ze Gu</h1>
                                <p>
                                    <label for="username" class="uname" data-icon="u" >登录帐号 </label>
                                    <input id="user" name="user" required="required" type="text" placeholder="请输入帐号"/>
                                </p>
                                <p>

                                    <label for="password" class="youpasswd" data-icon="p"> 登录密码  </label>
                                    <input id="pwd" name="pwd" required="required" type="password" placeholder="请输入密码" />
                                </p>
                                <p class="keeplogin">
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" />
									<label for="loginkeeping">记住密码</label>
								</p>
                                <p class="login button">
                                    <input type="submit" name="formSubmit"  value="登录"/>
								</p>

                            </form>
                        </div>



                    </div>
                </div>


       <div class="footer" style="background-color: rgba(0, 0, 0, 0.4);  " >Copyright 2016 by 泽谷库存管理系统</div>
        <?php $this->load->view('footer');?>
        <script>
        $('[name="formSubmit"]').click(function(){
        if ($("#user").val()=='') {
            layer.msg('请输入账号',{icon: 5,time:1000});return false;
        }
        if ($("#pwd").val()=='') {
            layer.msg('请输入密码',{icon: 5,time:1000});return false;
        }
      user=$("#user").val();
        pwd=$("#pwd").val();
        $.ajax({
          method: "post",
          url: "<?php echo site_url('login/check')?>",
          async: false,
          data: {
         user:user,
         pwd:pwd

          },
          dataType: "script",
          success: function(data){
            if(data == 1){
              layer.msg("成功",{icon: 6,time:2000});
              location.href="main";

            }else{
              layer.msg("账号或密码错误",{icon: 5,time:1000});
              console.log(data);
            }
          },
        });
        });
        </script>
    </body>
</html>
