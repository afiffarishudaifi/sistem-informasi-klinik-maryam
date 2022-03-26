<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="https://colorlib.com/etc/lf/Login_v14/images/icons/favicon.ico" />

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/css/util.css">
    <link rel="stylesheet" type="text/css" href="https://colorlib.com/etc/lf/Login_v14/css/main.css">

</head>
<body>
    <div class="limiter">
        <div class="row">
            <div class="col-md-4"></div>
                <div class="col-md-6" style="height: 50px;word-spacing: 30px;font-size: 25px;">
                    <a href="<?=base_url("logout")?>" class="btn btn-primary">Logout</a>
                </div>
                <div class="col-md-2"></div>
            </div>
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<span style="text-align: center; color: red;font-size: x-large;"><?php if(session()->getFlashData("Error")) echo session()->getFlashData("Error"); ?></span>
				<span style="text-align: center; color: red;font-size: x-large;"><?php if(session()->getFlashData("Success")) echo session()->getFlashData("Success"); ?></span>
				<form class="login100-form validate-form flex-sb flex-w" action="" method="post" >
					<span class="login100-form-title p-b-32"> User Login </span>

					<span class="txt1 p-b-11"> Email </span>
					<div class="wrap-input100 validate-input m-b-36" data-validate="Email is required">
						<input class="input100" type="text" name="email" value="">
						<span class="focus-input100"></span>						
						<span></span>
					</div>

					<span class="txt1 p-b-11"> Password </span>
					<div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span></span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn"> Login </button>
					</div>
				</form>
				<br>
				<?php 
					echo $googleButton;
				?>
			</div>
		</div>
	</div>
    <div id="dropDownSelect1"></div>

    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/animsition/js/animsition.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/bootstrap/js/popper.js"></script>
    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/select2/select2.min.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/daterangepicker/moment.min.js"></script>
    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v14/vendor/countdowntime/countdowntime.js"></script>

    <script src="https://colorlib.com/etc/lf/Login_v14/js/main.js"></script>
</body>
</html>
