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
                    <h3 class="tile-title">Editar Usuário</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <div class="col-md-12">
                    <form name="frmNovo" class='crud' method="POST" action="{{ url("usuarios/$usuarios->id") }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Login</label>
                                    <input class="pull-center form-control" type="text" name="login" placeholder="" value="{{ $usuarios->username }}" required>
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
                                        <option value="{{ $dados->cod }}" @if($usuarios->fk_status == $dados->cod) selected @endif>{{ $dados->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Funcionário</label>
                                    <select class="form-control" name="funcionario">
                                        <option value="">Selecione</option>
                                        @foreach($funcionarios as $dados)
                                        <option value="{{ $dados->id }}" @if($usuarios->fk_funcionario == $dados->id) selected @endif >{{ $dados->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Tipo</label>
                                <div class="form-check text-center">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="tipo" value="1" @if($usuarios->tipo == '1') checked @endif>Administrador
                                    </label>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="tipo" value="0" @if($usuarios->tipo == '0') checked @endif>Usuário
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
@endsection