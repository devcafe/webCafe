<script src = "resources/js/logon.js" type = "text/javascript"> </script>
<link rel="stylesheet" type="text/css" href="resources/css/logon.css">


<div id = "mainWrapper">
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

