$(document).ready(function(){

	//Ativa tooltip
	$( document ).tooltip({
      track: true
    });

	//Esconde modal
	$('#bandeirasModal').hide();
	$('#cadBandeirasModal').hide();

	//Validação de campos obrigatórios
	$('#numConfirm').hide();
	$('#numConfirmReceita').hide();
	$('#cnpjObrigatorio').hide();
	$('#bandeiraObrigatorio').hide();
	$('#nomeObrigatorio').hide();
	$('#enderecoObrigatorio').hide();
	$('#nomeEmpresarialObrigatorio').hide();
	$('#enderecoReceitaObrigatorio').hide();
	$('#situacaoDataObrigatorio').hide();
	$('#dataAberturaObrigatorio').hide();
	$('#cnpjCadastrado').hide();
	$('#nomeCadastrado').hide();	
	$('#lojaSucesso').hide();	
	$('#bandeiraCadastrada').hide();
	$('#bandeiraCadastradaSucesso').hide();
	$('#bandeiraObrigatorio').hide();
	$('#alterarLoja').hide();


	$("#numero").keypress(verificaNumero);
	$("#estabReceitaNumero").keypress(verificaNumero);
	$("#uf").keypress(verificaLetra);
	$("#cidade").keypress(verificaLetra);
	$("#estabReceitaCidade").keypress(verificaLetra);
	$("#estabReceitaUF").keypress(verificaLetra);
	$('#estabTel01').keypress(verificaNumero);
	$('#estabTel02').keypress(verificaNumero);

	//Mascara campos
	$("#cnpj").mask("99.999.999/9999-99");
	$("#cep").mask("99999-999");
	$('#estabReceitaCEP').mask("99999-999");
	//$('#estabTel01').mask("(99) 9999-9999");
	//$('#estabTel02').mask("(99) 9999-9999");

	$( "#estabReceitaAberturaData" ).datepicker();
	$( "#estabReceitaSituacaoData" ).datepicker();
	$( "#dataFechamento" ).datepicker();

	//Função para limpar campos antes da consulta do CEP
	function cleanFields(){
		$('#rua').val('');
		$('#bairro').val('');
		$('#cidade').val('');
		$('#uf').val('');
	}

	//Função para limpar campos antes da consulta do CEP (dados receita)
	function cleanFieldsReceita(){
		$('#estabReceitaEndereco').val('');
		$('#estabReceitaBairro').val('');
		$('#estabReceitaCidade').val('');
		$('#estabReceitaUF').val('');
	}	


	/* Executa a requisição quando o campo CEP perder o foco */
	$('#cep').focusout(function(){

		cleanFields();

		$.ajax({
			url: 'mod_operacional/ajax/carregaDadosCEP.php',
			type : 'POST', 
			data: 'cep=' + $('#cep').val(),
			dataType: 'json',
			success: function(data){
				if(data.sucesso == 1){										
					$('#rua').val(data.rua);
					$('#bairro').val(data.bairro);
					$('#cidade').val(data.cidade);
					$('#uf').val(data.estado);
					$('#numero').focus();
					
				}
			}
		});   
		return false;    
	})


	/* Executa a requisição quando o campo CEP da receita perder o foco */
	$('#estabReceitaCEP').focusout(function(){

		cleanFieldsReceita();

		$.ajax({
			url: 'mod_operacional/ajax/carregaDadosCEP.php',
			type : 'POST', 
			data: 'cep=' + $('#estabReceitaCEP').val(),
			dataType: 'json',
			success: function(data){
				if(data.sucesso == 1){
					$('#estabReceitaEndereco').val(data.rua);
					$('#estabReceitaBairro').val(data.bairro);
					$('#estabReceitaCidade').val(data.cidade);
					$('#estabReceitaUF').val(data.estado);

					$('#estabReceitaNumero').focus();
				}
			}
		});   
		return false;    
	})	


	//Cadastrar loja
	$('#cadLojaBtn').on('click', function(){
		var idLojaEdicao = $('#idLojaEdicao').val();
		//Dados do formulário
		var dados = $('#formCadLoja').serialize();		

		$('#formCadLoja input').each( function() {
			dados = dados + '&' + $(this).attr('name') + '=' + $(this).val();
		});

		if(validarNumeroZero('#numero') == true){			
			$('#numero').focus();					

		}else if(validarNumeroZero('#estabReceitaNumero') == true){			
			$('#estabReceitaNumero').focus();		

		}else if($('#numero').val() == ''){			
			$( "#numConfirm" ).dialog({
				resizable: false,
				height:180,
				width:500,
				modal: true,
				buttons: {
					"Ok": function() {
						$(this).dialog( "close" );

						$('#numero').val('S/N');

						if($('#estabReceitaNumero').val() == ''){
							$( "#numConfirmReceita" ).dialog({
								resizable: false,
								height:180,
								width:500,
								modal: true,
								buttons: {
									"Ok": function() {
										$( this ).dialog( "close" );

										$('#estabReceitaNumero').val('S/N');

										cadastraLoja();

									},
									Cancelar: function() {
										$( this ).dialog( "close" );
									}
								}
							});
						}

					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		} else if($('#estabReceitaNumero').val() == ''){
			$( "#numConfirmReceita" ).dialog({
				resizable: false,
				height:180,
				width:500,
				modal: true,
				buttons: {
					"Ok": function() {
						$( this ).dialog( "close" );

						$('#estabReceitaNumero').val('S/N');

						cadastraLoja();

					},
					Cancelar: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		} else {
			cadastraLoja();		
		}

					
		function cadastraLoja(){

			//Envia formulário
			$.ajax({
				type: 'POST',
				url: 'mod_operacional/ajax/cadLoja.php',
				data: {					
					dados: dados
				},
				success: function (data){
					if(data == 1){
						$( "#cnpjObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#cnpj').focus();
								},
							}
						});
					} else if (data == 2){
						$( "#bandeiraObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
								},
							}
						});
					} else if(data == 3){
						$( "#nomeObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#nome').focus();
								},
							}
						});
					} else if(data == 4){
						$( "#enderecoObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
								},
							}
						});
					} else if(data == 5){
						$( "#nomeEmpresarialObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#estabReceitaNomeEmpresarial').focus();
								},
							}
						});
					} else if(data == 6){
						$( "#enderecoReceitaObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
								},
							}
						});
					} else if(data == 7){
						$( "#dataAberturaObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#estabReceitaAberturaData').focus();
								},
							}
						});
					} else if(data == 8){
						$( "#situacaoDataObrigatorio" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#estabReceitaSituacaoData').focus();
								},
							}
						});
					}else if(data == 10){
						$( "#cnpjCadastrado" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#cnpj').focus();
								},
							}
						});
					}else if(data == 11){
						$( "#nomeCadastrado" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#nome').focus();
								},
							}
						});
					}else if(data == 12){
						$( "#alterarLoja" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#formCadLoja')[0].reset();
									$('#idLojaEdicao').val('');
									$('#idBandeiraHidden').val('');
									$('#legendMenu').empty().append('Cadastrar Loja');
									$('#cadLojaBtn').val('Cadastrar Loja');
									$('#cnpj').removeAttr('disabled');
								},
							}
						});
					}else{
						$( "#lojaSucesso" ).dialog({
							resizable: false,
							height:180,
							width:500,
							modal: true,
							buttons: {
								"Ok": function() {
									$( this ).dialog( "close" );
									$('#formCadLoja')[0].reset();
									
									
								},
							}
						});
					}
				}
			})
		}
		
		
	})

	//Abre modal para selecionar bandeira
	$('#selectBandeira').on('click', function(){
		//Abre modal com dados da loja
		$( "#bandeirasModal" ).dialog({
			width: 600,
			show: {
		        effect: "blind",
		        duration: 500
	     	}
		});
	})

	//Abre modal para adicionar bandeira
	$('#addBandeira').on('click', function(){
		//Abre modal com dados da loja
		$( "#cadBandeirasModal" ).dialog({
			width: 600,
			show: {
		        effect: "blind",
		        duration: 500
	     	}
		});
	})

	//Consulta bandeira
	$('#searchBandeiraBtn').on('click', function(){
		$('#pagina').val('1');
		carregaBandeiras();
	})

	/*$("#bandeiraSearch").keypress(function(event) {
	    if (event.which == 13) {
	    		carregaBandeiras();
	    		console.log("ok");
		    }
	})*/



	function carregaBandeiras(){
		$('#searchBandeiraResults').empty();

		var searchVal = $('#bandeiraSearch').val();
		var pag = $('#pagina').val();

		//Envia formulário
		$.ajax({
			type: 'POST',
			url: 'mod_operacional/ajax/carregaListaBandeiras.php',
			data: {
				searchVal: searchVal,
				pag: pag
			},
			success: function (data){
				$('#searchBandeiraResults').append(data);
			}
		})
	}

	//Muda de página
	$('#searchBandeiraResults').on('click', '.toPage', function(){

		//Verifica o novo id
		var newPage = $(this).attr('id');

		//Passa o novo id a um elemento hidden
		$('#pagina').val(newPage);

		//Chama a função para carregar proxima pagina
		carregaBandeiras();

	})

	$('#searchBandeiraResults').on('click', '#addBandeiraToList', function(){
		var selectedBandeiraId = $('input[name=estaBandeira]:checked', '#bandeirasForm').val();
		var selectedBandeiraNome = $('input[name=estaBandeira]:checked', '#bandeirasForm').next('label').html()

		$('#bandeira').val(selectedBandeiraNome);
		$('#idBandeiraHidden').val(selectedBandeiraId);

		//Destroy modal
      	$('#bandeirasModal').dialog("destroy");
	})


	//Tratamento dos campos para não aceitar acentuação
	$('input[type=text]').on('keypress', function(e,args){
		if (document.all){ var evt=event.keyCode; } //Caso seja IE
		else{ var evt = e.charCode; }	//Do contrário deve ser Mozilla

		var valid_chars = ' 0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_'+args; //Lista de teclas permitidas

		var chr= String.fromCharCode(evt);	//Pega a tecla digitada

		if (valid_chars.indexOf(chr)>-1 ){ return true; }	//Verifica se a tecla digitada esta na lista

		//Para permitir teclas como <BACKSPACE>
		if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;}	//Verifica se a tecla digitada esta na lista
			return false;	//Caso contrário nega
	})

	function verificaNumero(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    }

	  //só aceita letras
	function verificaLetra(e){
	     var tecla = (window.event) ? event.keyCode : e.which;

	     if((tecla > 65 && tecla < 90)
	         ||(tecla > 97 && tecla < 122))
	               return true;
	     else{
	          if (tecla != 8) return false;
	          else return true;
	     }
	}
	//verifica se o campo tem zeros por meio de ER
	
	function validarNumeroZero(e){
		var valor = $(e).val();
		var er = /^[0]{0,6}$/;
		if(valor != ''){
			if(er.test(valor)){
				$(e).focus();
				return true;
			}
		}
	}
	

	//Cadastra bandeira
	$('#cadBandeiraBtn').on('click', function(){
		var bandeira = $('#cadBandeiraNome').val();

		$.ajax({
			type: 'POST',
			url: 'mod_operacional/ajax/cadBandeiras.php',
			data: {
				bandeira: bandeira
			},
			success: function (data){
				if(data == 1){
					$( "#bandeiraCadastrada" ).dialog({
						resizable: false,
						height:180,
						width:500,
						modal: true,
						buttons: {
							"Ok": function() {
								$( this ).dialog( "close" );
							},
						}
					});
				} else if(data == 2){
					$( "#bandeiraCadastradaSucesso" ).dialog({
						resizable: false,
						height:180,
						width:500,
						modal: true,
						buttons: {
							"Ok": function() {
								$( this ).dialog( "close" );
							},
						}
					});
				} else {
					$( "#bandeiraObrigatorio" ).dialog({
						resizable: false,
						height:180,
						width:500,
						modal: true,
						buttons: {
							"Ok": function() {
								$( this ).dialog( "close" );
							},
						}
					});
				}
				
			}
		})
	})


	//verificar cnpj dinamicamente
	$('#status').hide();
	$('#status2').hide();

	$('#cnpj').keyup(function(){

		var verificarCnpj = $('#cnpj').val();

		$.ajax({
			type: 'POST',
			url: 'mod_operacional/ajax/verificaCnpj.php',
			data: {
				verificarCnpj: verificarCnpj
			},
			success: function (data){
				$('#status').show();
				//console.log(data);				
				if(data == 0){					
					if($('#status').hasClass('invalido')){
						$('#status').removeClass('invalido');
						$('#status').addClass('valido');						
						}
						$('#status2').hide();				
				}else if(data == 1){
					$('#status').removeClass('valido');
					$('#status').addClass('invalido');		
					$('#status2').empty('html');		
					$('#status2').hide();									
				}else{
					if($('#status').hasClass('valido')){
							$('#status').removeClass('valido');
							$('#status').addClass('invalido');									
						}
					$('#status2').empty('html');
					$('#status2').append(data);
					
					$('#status2').show();			
					
				}
				
			}
		})

	})

	//Gera nome da loja a partir da bandeira bairro e cidade
	$('#numero').focusout(function(){

		// pega os valores dos campos
		var aBandeira = $('#bandeira').val();
		var aBairro = $('#bairro').val();
		var aCidade = $('#cidade').val();

		// apenda os valor no campo da loja
		$('#nome').val(aBandeira + ' ' + aBairro + ' ' + aCidade);
	})


	
})