@extends('templates.template')
@section('title','Mensalidade')

@section('titulo','MENSALIDADE')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <form name="frmNovo" class='alter' method="POST" action="{{ url("mensalidades/$mensalidade->id") }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="tile-title">Pagar Mensalidade</h3>
                    </div>
                </div>
                <br>
                <h4>Conta</h4>
                <hr>
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            <label class="control-label">Conta</label>
                            <input class="text-center form-control" type="text" id="cod" name="cod" value="{{ substr('0000'.$mensalidade->conta->id, -4) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <input class="text-center form-control" type="text" name="status" placeholder="" value="{{ $mensalidade->conta->status->status }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Nome</label>
                            <input class="form-control" type="text" name="nome" placeholder="" value="{{ $mensalidade->conta->titular->nome }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">CPF</label>
                            <input class="form-control cpf" type="text" name="cpf" placeholder="" maxlength="14" value="{{ $mensalidade->conta->titular->cpf }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Plano</label>
                            <input class="form-control" type="text" name="plano" placeholder="" value="{{ $mensalidade->conta->plano->plano }}" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Pagamento</h4>
                <hr>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Período</label>
                            <input class="text-center form-control" type="text" name="periodo" placeholder="" value="{{ $mensalidade->periodo }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Valor</label>
                            <input class="form-control money" type="text" id="mensalidade" name="mensalidade" value="{{ number_format($mensalidade->conta->plano->mensalidade, 2, ',','.') }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Forma de Pagamento</label>
                                <select class="form-control" name="forma_pagamento" required>
                                    <option value="0">Selecione</option>
                                    @foreach($formasPagamento as $dados)
                                        <option value="{{ $dados->id }}" >{{$dados->descricao}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Data Pagamento</label>
                            <input class="form-control" type="date" name="data_pagamento" placeholder="" value="{{ $data }}" required>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ url('mensalidades') }}">
                            <button type="button" class="btn btn-primary" style="width:100px"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</button>
                        </a>&nbsp;
                        <input type="submit" class="btn btn-primary" style="width:100px" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection