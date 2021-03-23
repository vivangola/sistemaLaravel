@extends('templates.template')
@section('title','Estoque')

@section('titulo','ESTOQUE')
@section('icone','fa fa-archive')

@section('content')

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Controle de Estoque</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <div class="col-md-12">
                    <form name="frmNovo" class='alter' method="POST">
                        @method('PUT')
                        @csrf                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Material</label>
                                    <select class="form-control select2" name="material" id="material" required>
                                        <option value="" readonly>Selecione</option>
                                        @foreach($materiais as $dados)
                                        <option value="{{ $dados->id }}">{{ $dados->material }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Estoque Atual</label>
                                    <input class="pull-center form-control" type="numeric" id="estoque" placeholder="" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Operação</label>
                                    <select class="form-control" name="operacao" required>
                                        <option value="E">Entrada</option>
                                        <option value="S">Saída</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Quantidade</label>
                                    <input class="pull-center form-control" type="number" name="quantidade" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Observacao</label>
                                    <input class="pull-center form-control" type="text" name="observacao" placeholder="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('materiais') }}">
                                    <button type="button" class="btn btn-primary" style="width:100px"><i
                                            class="fa fa-arrow-left"></i>&nbsp;Voltar</button>
                                </a>&nbsp;
                                <input type="submit" class="btn btn-primary" style="width:100px" value="Enviar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<link href="{{ url('assets/css/select2.css') }}" rel="stylesheet" />
<script src="{{ url('assets/js/plugins/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
    $("#material").change(function() {
        $("form.alter").attr('action', '{{ url("estoque") }}/'+$(this).val());
        $('#material option')[0].value == "" ? $('#material option')[0].remove() : null; 
        $.ajax({
            url: "/materiais/" + $(this).val(),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#estoque').val(response.estoque);
            },
            error: function(response) {
                $('#estoque').val("");
            }
        });
    });
</script>
@endsection