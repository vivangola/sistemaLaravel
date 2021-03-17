@extends('templates.template')
@section('title','Óbitos')

@section('titulo','ÓBITOS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-2">
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Editar Óbito</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <form name="frmNovo" class='alterObito' method="POST" action="{{ url("obitos/$obito->id") }}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="inativa" name="inativa" value="0">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Conta</label>
                                <input class="pull-center form-control" type="text" id="codigo" value="{{ substr("0000".$conta->id,-4) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="control-label">Titular</label>
                                <select class="form-control" id="conta" name="conta" required readonly>
                                    <option value="{{ $conta->id }}">{{ $conta->titular->nome }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Falecido</label>
                                <select class="form-control" id="falecido" name="falecido" required>
                                    <option value="{{ $obito->falecido()->cpf }}">{{ $obito->falecido()->nome }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Local Falecimento</label>
                                <input type="text" class="form-control" name="local_falecimento" value="{{ $obito->local_falecimento }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Data Falecimento</label>
                                <input type="date" class="form-control" name="data_falecimento" value="{{ $obito->data_falecimento }}" required >
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Horário Falecimento</label>
                                <input type="time" class="form-control" name="hora_falecimento" value="{{ $obito->hora_falecimento }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Local Velório</label>
                                <input type="text" class="form-control" name="local_velorio" value="{{ $obito->local_velorio }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Data Velório</label>
                                <input type="date" class="form-control" name="data_velorio" value="{{ $obito->data_velorio }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Horário Velório</label>
                                <input type="time" class="form-control" name="hora_velorio" value="{{ $obito->hora_velorio }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Local Enterro</label>
                                <input type="text" class="form-control" name="local_enterro" value="{{ $obito->local_enterro }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Data Enterro</label>
                                <input type="date" class="form-control" name="data_enterro" value="{{ $obito->data_enterro }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Horário Enterro</label>
                                <input type="time" class="form-control" name="hora_enterro" value="{{ $obito->hora_enterro }}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('obitos') }}">
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
<script type="text/javascript" src="{{ url('assets/js/scriptObitos.js' )}}"></script>
<script>
    getPessoas({{ $conta->id }});
</script>
@endsection