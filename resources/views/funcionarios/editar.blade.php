@extends('templates.template')
@section('title','Funcionários')

@section('titulo','FUNCIONÁRIOS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Editar Funcionário</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <form name="frmNovo" class='alter' method="POST" action="{{ url("funcionarios/$funcionario->id") }}">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input class="form-control" type="text" name="nome" placeholder="" value="{{ $funcionario->nome }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CPF</label>
                                <input class="form-control cpf" type="text" name="cpf" placeholder="" maxlength="14" value="{{ $funcionario->cpf }}"required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">RG</label>
                                <input class="form-control" type="text" name="rg" placeholder="" value="{{ $funcionario->rg }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Endereço</label>
                                <input class="form-control" type="text" name="endereco" placeholder="" value="{{ $funcionario->endereco }}" tabIndex="-1" readonly>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Número</label>
                                <input class="form-control" type="text" name="numero" placeholder="" value="{{ $funcionario->numero }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Bairro</label>
                                <input class="form-control" type="text" name="bairro" placeholder="" value="{{ $funcionario->bairro }}" tabIndex="-1" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Cidade</label>
                                <input class="form-control" type="text" name="cidade" placeholder="" value="{{ $funcionario->cidade }}" tabIndex="-1" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado</label>
                                <select class="form-control" name="estado" tabIndex="-1" readonly>
                                    <option value="">Selecione</option>
                                    @foreach($estados as $estado)
                                        <option value="{{$estado->uf}}" @if($funcionario->estado_uf == $estado->uf) selected @endif >{{$estado->estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CEP</label>
                                <input class="form-control" type="text" name="cep" placeholder="" maxlength="9" value="{{ $funcionario->cep }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Cargo</label>
                                <input class="form-control" type="text" name="cargo" placeholder="" value="{{ $funcionario->cargo }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="" value="{{ $funcionario->email }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Telefone</label>
                                <input class="form-control" type="text" name="telefone" placeholder="" required value="{{ $funcionario->telefone }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nascimento</label>
                                <input class="form-control" type="date" name="nascimento" placeholder="" value="{{ $funcionario->nascimento }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sexo</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sexo" value="M" @if($funcionario->sexo == 'M') checked @endif >Masculino
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sexo" value="F" @if($funcionario->sexo == 'F') checked @endif>Feminino
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('funcionarios') }}">
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