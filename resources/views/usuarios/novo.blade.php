@extends('templates.template')
@section('title','Usuários')

@section('titulo','USUÁRIOS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Cadastrar Usuário</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <div class="col-md-12">
                    <form name="frmNovo" class='insert' method="POST" action="{{ url('usuarios') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Login</label>
                                    <input class="pull-center form-control" type="text" name="login" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Senha</label>
                                    <input class="pull-center form-control" type="password" name="senha" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Confirmação de Senha</label>
                                    <input class="pull-center form-control" type="password" name="confirmacao" placeholder="" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        @foreach($status as $dados)
                                        <option value="{{ $dados->id }}">{{ $dados->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Funcionário</label>
                                    <select class="form-control select2" name="funcionario">
                                        <option value="">Selecione</option>
                                        @foreach($funcionarios as $dados)
                                        <option value="{{ $dados->id }}">{{ $dados->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row m-1">
                            <div class="col-md-12">
                                <div class="form-check text-center">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="tipo" value="1">Administrador
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="tipo" value="0">Usuário
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('usuarios') }}">
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
</script>
@endsection