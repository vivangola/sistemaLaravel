
    $("#btnAdd").click(function() {
        var rows = $("#tblDependentes tbody tr").length;
        if ($("#tblDependentes tbody tr").length <= $("#qtd").val()) {
            var row = $("#tblDependentes")[0].insertRow(1);
            row.insertCell(0).innerHTML = '<input type="text" class="text-center form-control" name="dnome[]" required>';
            row.insertCell(1).innerHTML = '<input type="text" class="text-center form-control" name="dcpf[]" required>';
            row.insertCell(2).innerHTML = '<input type="date" class="text-center form-control" name="dnascimento[]" required>';
            row.insertCell(3).innerHTML = '<select class="text-center form-control" name="parentesco[]" required>'+$('#parentesco :selected').text() + $("#parentesco").html();+'</select>';
            row.insertCell(4).innerHTML = "<button class='btn btn-danger' type='button' value='Excluir' onclick='removeRow(this)'><i class='fa fa-trash'></i></button>";
        } else {
            swal({
                title: "Atenção!",
                text: "Quantidade máxima de dependentes atingida!",
                type: "warning",
            });
        }
    });

    $("#plano").change(function() {
        $('#plano option')[0].value == "" ? $('#plano option')[0].remove() : null; 
        var rows = $("#tblDependentes tbody tr").length-1;
        $.ajax({
            url: "/planos/" + $(this).val(),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (rows <= response.dependentes) {
                    $('#mensalidade').val(response.mensalidade);
                    $('#carencia').val(response.carencia);
                    $('#qtd').val(response.dependentes);
                    $('#previous').val(response.id);
                } else {
                    swal({
                        title: "Atenção!",
                        text: "Por favor remova "+ (rows-response.dependentes) +" dependente(s) para alterar o plano!",
                        type: "warning",
                    });
                    $('#plano').val($("#previous").val());
                }
            },
            error: function(response) {
                $('#mensalidade').val("");
                $('#carencia').val("");
                $('#qtd').val("");
            }
        });
    });


    function removeRow(item) {
        $("#tblDependentes")[0].deleteRow(item.parentNode.parentNode.rowIndex);
    }

    function tornarTitular(item) {
        $.each($(".titular").serializeArray(), function (_, field) {
            if(field.name != "_method" || field.name != "_token"){
                $("[name='"+field.name+"']").val('');
            }
         })
        $("[name='nome']").val($(item.parentNode.parentNode).find('td:nth-child(1) > input').val());
        $("[name='cpf']").val($(item.parentNode.parentNode).find('td:nth-child(2) > input').val());
        $("[name='nascimento']").val($(item.parentNode.parentNode).find('td:nth-child(3) > input').val());
        removeRow(item);
    }