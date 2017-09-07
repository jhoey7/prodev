<!DOCTYPE html>
<html>
	<head>
		<title>P.M v.0.1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8" />

		<link rel="icon" type="image/ico" href="<?php echo base_url();?>assets/images/favicon.ico" />
		<!-- Bootstrap -->
		<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-checkbox.css" rel="stylesheet">
    	<link href="<?php echo base_url(); ?>assets/css/jquery.jgrowl.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/minoral.css" rel="stylesheet">
	</head>
	<body class="brownish-scheme">
        <!-- Preloader -->
        <div class="mask"><div id="loader"></div></div>
        <!--/Preloader -->

		<!-- Wrap all page content here -->
		<div id="wrap">
        
            <!-- Make page fluid -->
            <div class="row">         

                <!-- Page content -->
                <div id="content" class="col-md-12 full-page login">
					<div class="welcome">
						<img src="<?php echo base_url(); ?>assets/images/logo-big.png" alt class="logo">
						<h1><strong>Project</strong> Management</h1>
						<h5>v. 0.1</h5>
						<form id="form-signin" class="form-signin" onsubmit="javascript:return Login()" action="<?php echo site_url(); ?>/user/login/<?= $this->session->userdata('session_id'); ?>">
                            <section>
                                <div class="input-group _usr">
                                	<input type="text" class="form-control" name="username" id="_usr" placeholder="Username">
                                	<div class="input-group-addon"><i class="fa fa-user"></i></div>
                                </div>
                                <div class="input-group password">
                                	<input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                	<div class="input-group-addon"><i class="fa fa-key"></i></div>
                                </div>
                            </section>
                            <input type="submit" style="display:none">
						</form>
					</div>
					<a href="javascript:void(0);" onClick="Login();return false;" class="log-in">Log In<i class="fa fa-arrow-right fa-5x"></i></a>
				</div>
				<!-- Page content end -->
            </div>
            <!-- Make page fluid-->
        </div>
        <!-- Wrap all page content end -->

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/minoral.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
    	<script src="<?php echo base_url(); ?>assets/js/plugins/jgrowl/jquery.jgrowl.min.js"></script>
        
        <script>			
			function Login(){
				var a=0;	
				$('#form-signin .form-control' ).each(function(n,element){
					if ($(element).val()==''){
						a = a+1;console.log($("."+element.id));
						$("."+element.id).css("border-radius","4px 4px 4px 4px");
						$("."+element.id).css("border","1px solid red");
					}else{
						$("."+element.id).css("border","");
					}  
				});  	
				if(a>0){
					if($("#_usr").val()==""){
						$.jGrowl("Isi Username terlebih terlebih dahulu!");
						$("#_usr").focus();
					}
					else if($("#password").val()==""){
						$.jGrowl("Isi Password terlebih terlebih dahulu!");
						$("#password").focus();
					}
					return false;
				}
				else{
					ExecFormLogin();
				}
				return false;
			}
			
			function ShowErrorBox(DivID,message){
				$(DivID).hide();
				$(DivID).html(message);
				$(DivID).fadeIn('slow');
			}
			
			function ExecFormLogin(){
				$.ajax({
					type: 'POST',
					url: $("#form-signin").attr('action') + '/ajax',
					data: $("#form-signin").serialize(),
					dataType: 'html',
					success: function(data){
						if(typeof(data) != 'undefined'){
							var arrayDataTemp = data.split("|");
							if(arrayDataTemp[0] !=1  ) {
								$.jGrowl(arrayDataTemp[1]);
							} else if(arrayDataTemp[0] == 1) {
								$.jGrowl(arrayDataTemp[1]);
								setTimeout(function(){window.location.reload(true)}, 2000);
							}
						}
					}
				});			
			}
        </script>
	</body>
</html>