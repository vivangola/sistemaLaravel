@extends('templates.template')
@section('title','Empréstimos')

@section('titulo','EMPRÉSTIMOS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Novo Empréstimo</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <form name="frmNovo" class='insert' method="POST" action="{{ url('emprestimos') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="control-label">Material</label>
                                <select class="form-control select2" id="material" name="material" required>
                                    <option value="">Selecione</option>
                                    @foreach($materiais as $dados)
                                    <option value="{{ $dados->id }}">{{ $dados->material }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Estoque</label>
                                <input class="pull-center form-control text-center" type="text" id="estoque" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Modelo</label>
                                <input class="pull-center form-control" type="text" id="modelo" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tamanho</label>
                                <input class="pull-center form-control" type="text" id="tamanho" readonly>
                            </div>
                        </div>
                    </div>
                    <!--div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Descrição</label>
                                <input class="pull-center form-control" type="text" id="descricao" readonly>
                            </div>
                        </div>
                    </div-->
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Conta</label>
                                <input class="pull-center form-control" type="text" id="codigo" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Titular</label>
                                <select class="form-control select2" id="conta" name="conta" required>
                                    <option value="">Selecione</option>
                                    @foreach($titulares as $dados)
                                        <option value="{{ $dados->id }}">{{ $dados->titular->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Quantidade</label>
                                <input class="pull-center form-control" type="number" name="quantidade" value="1">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('emprestimos') }}">
                                <button type="button" class="btn btn-primary" style="width:100px"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</button>
                            </a>&nbsp;
                            <input type="submit" class="btn btn-primary" style="width:100px" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="{{ url('assets/css/select2.css') }}" rel="stylesheet" />
<script src="{{ url('assets/js/plugins/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
    $("#conta").change(function() {
        $('#conta option')[0].value == "" ? $('#conta option')[0].remove() : null; 
        $("#codigo").val(("0000"+$(this).val()).substr(-4));
    });
    $("#material").change(function() {
        $('#material option')[0].value == "" ? $('#material option')[0].remove() : null; 
        $.ajax({
            url: "/materiais/" + $(this).val(),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#estoque').val(response.estoque);
                $('#modelo').val(response.modelo);
                $('#tamanho').val(response.tamanho);
                $('#descricao').val(response.descricao);
            },
            error: function(response) {
                $('#estoque').val("");
            }
        });
    });
</script>
@endsection