$(document).ready(function(){	
	
	//Botão de login
	$('#btnLogin').click(function() {
		//Pega os valores dos campos
		var userLogin = $('#userLogin').val(); 
		var pwdLogin = $('#pwdLogin').val();
		
		//Envia via ajax para o logon	
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
					alert("Usuário ou senha incorreto");
				}
			}
		})		
	});

	//Botão esqueceu a senha
	$('#forgotLogin').click(function(){
		alert('Favor contatar o administrador do sistema');	
	});

	//Botão de login
	$('#loginForm').keypress(function(event) {2
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
						alert("Usuário ou senha incorreto");
					}
				}
			})
		}		
	});	
});