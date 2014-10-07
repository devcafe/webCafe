<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title> WebCafé </title>

		<!-- CSS -->
		<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
		<link href = "resources/css/style.css" type = "text/css" rel = "stylesheet">
		
		<!-- Script -->
		<script src = "libs/jquery/jquery-1.11.1.js" type = "text/javascript"> </script>
		<script src = "libs/bootstrap/js/bootstrap.js" type = "text/javascript"> </script>
		<script src = "resources/js/logon.js" type = "text/javascript"> </script>

	</head>
	<body>
		<div id = "mainWrapper" class="col-xs-12">
			<div id = "formWrapper">
				<div id = "login">
					<form class="form-horizontal" role="form" method="post" id="loginForm">
						<h1>WebCafé</h1>
						<div class="form-group">
							<label for="userLogin" class="col-sm-2 control-label">Usuario</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="userLogin" placeholder="Usuario">
							</div>
						</div>
						<div class="form-group">
							<label for="pwdLogin" class="col-sm-2 control-label">Password</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" id="pwdLogin" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="remember"> Lembre-me
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type = "button" id = "btnLogin" name= "btnLogin" value = "Login" class= "btn btn-primary">
								<input type = "button" id = "forgotLogin" name= "forgotLogin" value = "Esqueceu a senha?" class= "btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">
							</div>
						</div>
					</form>

				</div>
			</div>
			
		</div>
	</body>
</html>

