<?php
$local="";
require "../conn/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOGIN </title> 
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-30 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w">
					<span style="background: #82828252;
    color: white;
    border-radius: 128px;
    padding: 1%;" class="login100-form-title">
						<h2><?php echo $local['nombre']?></h2>
					</span>

					
					<div class="wrap-input100 validate-input m-t-10" data-validate = "Ingresar usuario.">
						<input id="user" class="input100" type="text" placeholder="Ingrese su usuario" name="user" >
						<span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input m-t-10" data-validate = "Ingresar pass.">
						<input id="pass" class="input100" placeholder="Ingrese su contrase√±a" type="password" name="pass" >
						<span class="focus-input100"></span>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button id="submitBtn" class="login100-form-btn">
							Ingresar
						</button>
					</div>

				
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	<!-- //////////////////////////////////////////////77 -->
	<!--Modal: modalConfirmDelete-->
	<div class="modal fade" id="error" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
	  <!--Content-->
	  <div class="modal-content text-center">
		<!--Header-->
		<div class="modal-header d-flex justify-content-center">
		  <p class="heading">Error de usuario!</p>
		</div>
	
		<!--Body-->
		<div class="modal-body">
	
		  <h1 class="text-center">x</h1>
	
		</div>
	
		<!--Footer-->
		<div class="modal-footer">
	
		  <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cerrar</a>
		</div>
	  </div>
	  <!--/.Content-->
	</div>
	</div>
	<!--Modal: modalConfirmDelete-->





<script> 
    
    if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js')
            .then(function(registration) {
              console.log('Service Worker registrado con è´±xito:', registration);
            })
            .catch(function(error) {
              console.log('Error al registrar el Service Worker:', error);
            });
        }
   
    </script>




<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<script src="js/loguear.js"></script>

</body>
</html>