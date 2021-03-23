@extends('templates.template')
@section('title','Materiais')

@section('titulo','MATERIAIS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Cadastrar Materiais</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <div class="col-md-12">
                    <form name="frmNovo" class='insert' method="POST" action="{{ url('materiais') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Material</label>
                                    <input class="pull-center form-control" type="text" name="material" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Modelo</label>
                                    <input class="pull-center form-control" type="text" name="modelo" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tamanho</label>
                                    <input class="pull-center form-control" type="text" name="tamanho" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Qtd. Mínima</label>
                                    <input class="pull-center form-control" type="number" name="quantidade" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Descrição</label>
                                    <input class="pull-center form-control" type="text" name="descricao" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Categoria</label>
                                    <select class="form-control" name="categoria" required>
                                        <option value="">Selecione</option>
                                        @foreach($categorias as $dados)
                                        <option value="{{ $dados->id }}">{{ $dados->categoria }}</option>
                                        @endforeach
                                    </select>
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
@endsection