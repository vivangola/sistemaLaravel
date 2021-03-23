	
	$('.select2').select2();
    
    $("#conta").change(function() {
		$('#conta option')[0].value == "" ? $('#conta option')[0].remove() : null; 
        $("#codigo").val(("0000"+$(this).val()).substr(-4));
        getPessoas($(this).val());
    });

    function getPessoas(id){
        $.ajax({
            url: "/contas/" + id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response != ""){
                    var html = $("[name='_method']").val() == 'PUT' ? $('#falecido').html() : '';
                    $.each(response, function(i, dados) {
                        html += '<option value="'+dados.cpf+'">'+dados.nome+'</option>'
                    });
                    $("#falecido").html(html);
                }
            },
            error: function(response) {
                swal("Atenção!", "Erro ao Consultar Titular/Dependentes!", "error");
            }
        });
    }

    $("form.alterObito").submit(function(evt){
        evt.preventDefault();
        var form = $(this);
        swal({
            title: "Atenção!",
		    text: "Deseja mesmo continuar?",
		    icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((resposta) => {
            if (resposta) {
                $.ajax({
                    url: '/contas/titular?c='+$("#conta").val(),
                    type: 'GET',
                    dataType: 'json',
                    async: false,
                    success: function(response){
                        if(response.cpf == $("#falecido").val()){
                            swal({
                                title: "Atenção!",
                                text: "Voce selecionou o titular da conta. Deseja inativar-la?",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            }).then((resposta) => {
                                if (resposta) {
                                    $("#inativa").val(1);
                                    submitForm(form);
                                }else{
                                    submitForm(form);
                                } 
                            });
                        }else{
                            submitForm(form);
                        }
                    },
                    error: function(response){
                        $.each(response.responseJSON.errors, function( index, value ) {
                            swal("Atenção!", value.toString(), "warning");
                        });
                    }
                });
            }
        });
    });

    $("form.insertObito").submit(function(evt){
        evt.preventDefault();
        var form = $(this);
        $.ajax({
            url: '/contas/titular?c='+$("#conta").val(),
            type: 'GET',
            dataType: 'json',
            async: false,
            success: function(response){
                if(response.cpf == $("#falecido").val()){
                    swal({
                        title: "Atenção!",
                        text: "Voce selecionou o titular da conta. Deseja inativar-la?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((resposta) => {
                        if (resposta) {
                            $("#inativa").val(1);
                            submitForm(form);
                        }else{
                            submitForm(form);
                        } 
                    });
                }else{
                    submitForm(form);
                }
            },
            error: function(response){
                $.each(response.responseJSON.errors, function( index, value ) {
                    swal("Atenção!", value.toString(), "warning");
                });
            }
        });
    });