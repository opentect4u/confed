<!DOCTYPE html>
<html lang="en">
<head>
	<title>Confed-Login</title>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link rel="icon" type="image/png" href="<?php //echo base_url("/assets/login/images/icons/favicon.ico")?>"/> -->
	<link rel="icon" href="<?php echo base_url("/confed.jpg"); ?>">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/bootstrap/css/bootstrap.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/animate/animate.css")?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/css-hamburgers/hamburgers.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/animsition/css/animsition.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/select2/select2.min.css")?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/vendor/daterangepicker/daterangepicker.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/css/util.css")?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("/assets/login/css/main.css")?>">
<!--===============================================================================================-->

<style>
	img {
	float: left;
	}
	p.title 
	{
		font: 15px arial, sans-serif;
	}
</style>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w"  id="login" method="POST" action="<?php echo site_url("User_Login/index") ?>">
					<span class="login100-form-title p-b-20">
						<p class= "title"><img src="<?php echo base_url('confed.jpg'); ?>" style= "width:170px;height:100px;margin-right:15px;" alt="logo">				
							<font color="red">WEST BENGAL</font> <font color= "black">STATE</font> <font color= "red" >MULTIPURPOSE</font> <font color="black"> CONSUMERS' FEDERATION LIMITED </font>
						</p>
					</span>
					<hr>
					<!-- <span class="login100-form-title p-b-10" >
						Account Login
					</span> -->
					
					<span class="txt1 p-b-11">
						Username
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username is required">
						<input class="input100" type="text" name="user_id" />
						<span class="focus-input100"></span>
					</div>
					
					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-12" data-validate = "Password is required">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="user_pwd" />
						<span class="focus-input100"></span>
					</div>
					<span class="txt1 p-b-11">
						Module
					</span>
					<div class="wrap-input100">
                <select  class="module_type"  style="width:390px;height:40px;" id="module_type"  name="module_type">
                              <option value="Others">Others</option>
                              <option value="Paddy">Paddy</option>
                </select>
				</div>
					<span class="txt1 p-b-11" id="kms_txt">
						KMS YEAR
					</span>
					<div class="wrap-input100">
                <!-- <select  class="input100"  id="module_type"  name="module_type">
                              <option value="Others">Others</option>
                              <option value="Paddy">Paddy</option>
                </select> -->
				<select class="kms_yr" style="width:390px;height:40px;" name="kms_yr" id="kms_yr">

								<option value ="">Please Select KMS Year</option>

								<?php

									foreach($kms_yr as $row){ ?>

										<option value="<?php echo $row->kms_yr ?>"><?php echo $row->kms_yr; ?></option>
									<?php
										}
									?>

							</select>


              </div>
			  
			  
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/jquery/jquery-3.2.1.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/animsition/js/animsition.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/bootstrap/js/popper.js")?>"></script>
	<script src="<?php echo base_url("/assets/login/vendor/bootstrap/js/bootstrap.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/select2/select2.min.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/")?>vendor/daterangepicker/moment.min.js"></script>
	<script src="<?php echo base_url("/assets/login/vendor/daterangepicker/daterangepicker.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/vendor/countdowntime/countdowntime.js")?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url("/assets/login/js/main.js")?>"></script>
	<script>
		$(document).ready(function(){
			$("#login").on('submit',function(){

				var kmyr = $("#kms_yr").val();
				var module_type = $("#module_type").val();
				if(module_type == "Paddy"){
					if(kmyr == ""){
						alert("Please select KMS year");
						return false;
					}
				}
				
			});
		});

	</script>

<script>
$(document).ready(function () {
   
    $('#kms_yr').hide();
	$('#kms_txt').hide();
    $('#module_type').change(function () {
		var module_type = $("#module_type").val();

		if(module_type == "Paddy"){
			$('#kms_yr').show();
			$('#kms_txt').show();
					return false;
			}
				
			if(module_type == "Others"){
			$('#kms_yr').hide();
			$('#kms_txt').hide();
					return false;
			}
				
    })
});
</script>
</body>
</html>

