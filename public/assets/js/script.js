
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
	