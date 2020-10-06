@extends('templates.template')
@section('title','Estoque')

@section('titulo','ESTOQUE')
@section('icone','fa fa-archive')

@section('content')
<style>
    .select2-container--default .select2-selection--single {
        height: 37px !important;
        padding: 0.375rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.33;
        border-radius: 4px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        top: 85% !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 20px !important;
    }
    .select2-container--default .select2-selection--single {
        border: 2px solid #ced4da !important;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
    }
</style>
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
                    <form name="frmNovo" class='crud' method="POST">
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
                                    <input class="pull-center form-control" type="numeric" name="quantidade" placeholder="" required>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
    $("#material").change(function() {
        $("form.crud").attr('action', '{{ url("estoque") }}/'+$(this).val());
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