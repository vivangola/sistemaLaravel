
$("form.crud").submit(function(evt){
	evt.preventDefault();
	$.ajax({
		url: $(this).attr('action'),
		type: 'POST',
		dataType: 'json',
		data: $(this).serialize(),
		success: function(response){
			if(response.success){
				swal({ 
					title: "Sucesso!", 
					msg: "", 
					type: "success",
				},function(){ 
					location.reload();
				});
			}else{
				swal("Atenção!", response.msg, "warning");
			}
		},
		error: function(response){
			$.each(response.responseJSON.errors, function( index, value ) {
				swal("Atenção!", value, "warning");
			});
		}
	});
});

$("[name='cep']").keyup(function(){
	if( (($(this).val()).replace('-','')).length == 8){
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
					$("[name='estado'").val(response.uf);
				}
			},
			error: function(response){
				swal("Atenção!", "Erro ao buscar cep", "warning");
			}
		});
	}
});