@extends('templates.template')
@section('title','Planos')

@section('titulo','PLANOS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        <div class="tile">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="tile-title">Editar Planos</h3>
                </div>
            </div>
            <hr>
            <div class="tile-body">
                <div class="col-md-12">
                    <form name="frmNovo" class='alter' method="POST" action="{{ url("planos/$plano->id") }}">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Plano</label>
                                    <input class="pull-center form-control" type="text" name="plano" placeholder="" value="{{ $plano->plano }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mensalidade</label>
                                    <input class="pull-center form-control money" type="text" name="mensalidade" placeholder="" value="{{ number_format($plano->mensalidade, 2, ',', '') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Dependentes</label>
                                    <input class="pull-center form-control" type="number" name="dependentes" placeholder="" value="{{ $plano->dependentes }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status" required>
                                        @foreach($status as $dados)
                                        <option value="{{ $dados->id }}" @if($plano->tipo_status_id == $dados->id) selected @endif>{{ $dados->status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Carência</label>
                                    <select class="form-control" name="carencia" required>
                                        <option value="1">1 Mês</option>
                                        @for($i=2;$i<=12;$i++)
                                            <option value="{{ $i }}" @if($i == $plano->carencia) selected @endif >{{ $i.' Meses'}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <a href="{{ url('planos') }}">
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