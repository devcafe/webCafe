<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<title> WebCafé </title>

		<!-- CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
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

					<form method="post" id="loginForm">
						<h1>WebCafé</h1>
						<table>
							<tr> 
								<td><label for = "userLogin"> USUARIO  </label></td>
								<td><input type = "text" id = "userLogin" name= "userLogin"> </td>

							</tr>

							<tr> 
								<td><label for = "pwdLogin"> PASSWORD  </label></td>
								<td><input type = "password" id = "pwdLogin" name= "pwdLogin"></td>
							</tr>

							<tr> 
								<td></td>
								<td>
									<input type = "button" id = "btnLogin" name= "btnLogin" value = "Login" class= "btn btn-primary">
									<input type = "button" id = "forgotLogin" name= "forgotLogin" value = "Esqueceu a senha?" class= "btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">
								</td>
							</td>   
						</table>
					</form>
				</div>
			</div>
			
		</div>
	</body>
</html>

