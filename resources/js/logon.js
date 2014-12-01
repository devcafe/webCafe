$(document).ready(function(){
	//Esconde nota
	$('#nota').hide();

	//Botão de login
	$('#btnLogin').click(function() {
		$('#nota').hide();
		//Pega os valores dos campos
		var userLogin = $('#userLogin').val(); 
		var pwdLogin = $('#pwdLogin').val();
		var remember = $('#remember').is(':checked');		
		
		//Envia via ajax para o logon	
		$.ajax({
			url: 'actions/logonController.php',
			type: 'POST',			
			data: {
				userLogin : userLogin,
				pwdLogin : pwdLogin,
				remember: remember,
			},
			success: function(data){				
				if(data == 1){
					//Redireciona para a view principal
					window.location.href = "main.php?page=home";
				} else if(data == 2){
					$('#nota').show();
				}
			}
		})		
	});

	//Botão esqueceu a senha
	$('#forgotLogin').click(function(){
		alert('Favor contatar o administrador do sistema');	
	});

	//Botão de login
	$('#loginForm').keypress(function(event) {
		$('#nota').hide();
		 if (event.which == 13) {
	        event.preventDefault();

			//Pega os valores dos campos
			var userLogin = $('#userLogin').val(); 
			var pwdLogin = $('#pwdLogin').val();		

			$.ajax({
				url: 'actions/logonController.php',
				type: 'POST',			
				data: {
					userLogin : userLogin,
					pwdLogin : pwdLogin,
				},
				success: function(data){
					console.log(data);
					if(data == 1){
						//Redireciona para a view principal
						window.location.href = "main.php?page=home";
					} else if(data == 2){
						$('#nota').show();
					}
				}
			})
		}		
	});	
});