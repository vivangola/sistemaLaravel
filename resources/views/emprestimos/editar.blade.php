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
                    <h3 class="tile-title">Devolução Empréstimo</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <form name="frmNovo" class='alter' method="POST" action="{{ url("emprestimos/$emprestimo->id") }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="control-label">Material</label>
                                <select class="form-control" id="material" name="material" readonly>
                                    <option value="{{ $material->id }}">{{ $material->material }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Estoque</label>
                                <input class="pull-center form-control text-center" type="text" id="estoque" value="{{ $material->estoque }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Modelo</label>
                                <input class="pull-center form-control" type="text" id="modelo" value="{{ $material->modelo }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tamanho</label>
                                <input class="pull-center form-control" type="text" id="tamanho" value="{{ $material->tamanho }}" readonly>
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
                                <input class="pull-center form-control" type="text" id="codigo" value="{{ substr('0000'.$titular->conta_id, -4) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Titular</label>
                                <select class="form-control" id="conta" name="conta" readonly>
                                    <option value="{{ $titular->conta_id }}">{{ $titular->nome }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Quantidade</label>
                                <input class="pull-center form-control" type="number" name="quantidade" value="{{ $emprestimo->quantidade }}" >
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
@endsection