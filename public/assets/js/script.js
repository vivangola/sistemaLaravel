
$("form.insert").submit(function(evt){
	evt.preventDefault();
	submitForm($(this));
});

$("form.alter").submit(function(evt){
	evt.preventDefault();
	swal({
		title: "Atenção!",
		text: "Deseja mesmo continuar?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	}).then((resposta) => {
		if (resposta) {
			submitForm($(this));
		} 
	});
});

function submitForm(form){	
	
	$.each($(".cpf, .cep"), function( index, input ) {
		$("[name='"+input.name+"']").val($("[name='"+input.name+"']").val().replace(/[^\w\s]/gi, ''));
	});
	$.each($(".money"), function( index, input ) {
		$("[name='"+input.name+"']").val($("[name='"+input.name+"']").val().replace(',','.').replace(/[^0-9\.]+/g, ''));
	});
	if(typeof $("[name='dcpf[]']").val() != "undefined"){
		$.each($("[name='dcpf[]']"), function( index, input ) {
			$("[name='dcpf[]']")[index].value=(input.value.replace(/[^\w\s]/gi, ''));
		});
	}
	$.ajax({
		url: form.attr('action'),
		type: 'POST',
		dataType: 'json',
		data: form.serialize(),
		success: function(response){
			if(response.success){
				swal({ 
					title: "Sucesso!", 
					msg: (response.msg).toString(), 
					type: "success",
				}).then(() => { 
					location.reload();
				});
			}else{
				startMaskMoney();
				swal("Atenção!", (response.msg).toString(), "warning");
			}
		},
		error: function(response){
			$.each(response.responseJSON.errors, function( index, value ) {
				startMaskMoney();
				swal("Atenção!", value.toString(), "warning");
			});
		}
	});
}

$("[name='cep']").keyup(function(){
	if((($(this).val()).replace('-','').replaceAll('_','')).length == 8){
		$.ajax({
			url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/',
			type: 'GET',
			dataType: 'json',
			success: function(response){
				if(response.erro){
					swal("Atenção!", "Cep inválido", "warning");
					$("[name='cep']").val("");
				}else{
					$("[name='endereco']").val(response.logradouro);
					$("[name='bairro']").val(response.bairro);
					$("[name='cep']").val(response.cep);
					$("[name='cidade']").val(response.localidade);
					$("[name='estado']").val(response.uf);
				}
			},
			error: function(response){
				swal("Atenção!", "Erro ao buscar cep", "warning");
			}
		});
	}
});