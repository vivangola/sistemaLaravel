@extends('templates.template')
@section('title','Contas')

@section('titulo','CONTAS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <form name="frmNovo" class='crud' method="POST" action="{{ url('contas') }}">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="tile-title">Cadastrar Contas</h3>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <select class="form-control" name="status">
                                @foreach($status as $dados)
                                <option value="{{$dados->id}}">{{$dados->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Planos</h4>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Plano</label>
                            <select class="form-control" id="plano" name="plano" required>
                                <option value="">Selecione</option>
                                @foreach($planos as $dados)
                                <option value="{{$dados->id}}">{{$dados->plano}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="previous">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Mensalidade</label>
                            <input class="form-control" type="text" id="mensalidade" name="mensalidade" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Carência</label>
                            <input class="form-control" type="text" id="carencia" name="carencia" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Qtd. Dependentes</label>
                            <input class="form-control" type="text" id="qtd" name="qtd" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Titular</h4>
                <hr>
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input class="form-control" type="text" name="nome" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CPF</label>
                                <input class="form-control" type="text" name="cpf" placeholder="" maxlength="14" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">RG</label>
                                <input class="form-control" type="text" name="rg" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Endereço</label>
                                <input class="form-control" type="text" name="endereco" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Número</label>
                                <input class="form-control" type="text" name="numero" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Bairro</label>
                                <input class="form-control" type="text" name="bairro" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Cidade</label>
                                <input class="form-control" type="text" name="cidade" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado</label>
                                <select class="form-control" name="estado" required>
                                    <option value="">Selecione</option>
                                    @foreach($estados as $estado)
                                    <option value="{{$estado->uf}}">{{$estado->estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CEP</label>
                                <input class="form-control" type="text" name="cep" placeholder="" maxlength="9" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado Civil</label>
                                <select class="form-control" name="civil" required>
                                    <option value="">Selecione</option>
                                    @foreach($civil as $dados)
                                    <option value="{{ $dados->id }}">{{$dados->estado_civil}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Telefone</label>
                                <input class="form-control" type="text" name="telefone" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nascimento</label>
                                <input class="form-control" type="date" name="nascimento" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sexo</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sexo" value="M" required>Masculino
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sexo" value="F" required>Feminino
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4>Dependentes</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input class="form-control dp" type="text" id="dnome" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CPF</label>
                                <input class="form-control dp" type="text" id="dcpf" placeholder="" maxlength="14">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nascimento</label>
                                <input class="form-control dp" type="date" id="dnascimento" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Parentesco</label>
                                <select class="form-control dp" id="parentesco">
                                    <option value="">Selecione</option>
                                    @foreach($parentescos as $dados)
                                    <option value="{{ $dados->id }}">{{$dados->parentesco}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" id="btnAdd" class="btn btn-primary">Adicionar&nbsp;&nbsp;<i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center p-5">
                            <table class="table table-bordered" id="tblDependentes">
                                <thead style="background-color: #364756; color: #fff;">
                                    <tr class="text-center">
                                        <th width="30%">Nome</th>
                                        <th width="20%">CPF</th>
                                        <th width="10%">Nascimento</th>
                                        <th width="20%">Parentesco</th>
                                        <td width="5%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('contas') }}">
                                <button type="button" class="btn btn-primary" style="width:100px"><i
                                        class="fa fa-arrow-left"></i>&nbsp;Voltar</button>
                            </a>&nbsp;
                            <input type="submit" class="btn btn-primary" style="width:100px" value="Enviar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    <script>
    $("#btnAdd").click(function() {
        var rows = $("#tblDependentes tbody tr").length;
        if ($("#tblDependentes tbody tr").length <= $("#qtd").val()) {
            if ($('#dnome').val() == "" || $('#dcpf').val() == "" || $('#dnascimento').val() == "" || $(
                    '#parentesco').val() == "") {
                swal({
                    title: "Atenção!",
                    text: "Preencha todos os campos do dependente!",
                    type: "warning",
                });
            } else {
                var row = $("#tblDependentes")[0].insertRow(1);
                row.insertCell(0).innerHTML = '<input type="text" class="text-center form-control" name="dnome[]" value="'+$('#dnome').val()+'" readonly>';
                row.insertCell(1).innerHTML = '<input type="text" class="text-center form-control" name="dcpf[]" value="'+$('#dcpf').val()+'" readonly>';
                row.insertCell(2).innerHTML = '<input type="date" class="text-center form-control" name="dnascimento[]" value="'+$('#dnascimento').val()+'" readonly>';
                row.insertCell(3).innerHTML = '<select class="text-center form-control" name="parentesco[]" readonly><option value="'+$('#parentesco :selected').val()+'">'+$('#parentesco :selected').text()+'</option></select>';;
                row.insertCell(4).innerHTML = "<button class='btn btn-danger' type='button' value='Excluir' onclick='removeRow(this)'><i class='fa fa-trash'></i></button>";
                $('.dp').val("");
            }
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
</script>
@endsection