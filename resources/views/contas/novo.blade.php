@extends('templates.template')
@section('title','Contas')

@section('titulo','CONTAS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <form name="frmNovo" class='insert' method="POST" action="{{ url('contas') }}">
                @csrf
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="tile-title">Cadastrar Contas</h3>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Status:&nbsp;</label>
                            <select class="form-control" name="status">
                                @foreach($status as $dados)
                                <option value="{{$dados->id}}">{{$dados->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <div class="tile-body">
                    <h4>Planos</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Plano</label>
                                <select class="form-control select2" id="plano" name="plano" required>
                                    <option value="">Selecione</option>
                                    @foreach($planos as $dados)
                                    <option value="{{$dados->id}}">{{$dados->plano}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="previous">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Mensalidade</label>
                                <input class="form-control money" type="text" id="mensalidade" name="mensalidade" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Carência</label>
                                <input class="form-control" type="text" id="carencia" name="carencia" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Qtd. Dependentes</label>
                                <input class="form-control" type="text" id="qtd" name="qtd" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4>Titular</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input class="form-control" type="text" name="nome" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CPF</label>
                                <input class="form-control cpf" type="text" name="cpf" placeholder="" maxlength="14" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">RG</label>
                                <input class="form-control" type="text" name="rg" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Endereço</label>
                                <input class="form-control" type="text" name="endereco" placeholder="" tabIndex="-1" readonly required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Número</label>
                                <input class="form-control" type="text" name="numero" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Bairro</label>
                                <input class="form-control" type="text" name="bairro" placeholder="" tabIndex="-1" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Cidade</label>
                                <input class="form-control" type="text" name="cidade" placeholder="" tabIndex="-1" readonly required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado</label>
                                <select class="form-control" name="estado" tabIndex="-1" readonly required>
                                    <option value="">Selecione</option>
                                    @foreach($estados as $estado)
                                    <option value="{{$estado->uf}}">{{$estado->estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CEP</label>
                                <input class="form-control cep" type="text" name="cep" placeholder="" maxlength="9" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado Civil</label>
                                <select class="form-control" name="civil" required>
                                    <option value="">Selecione</option>
                                    @foreach($civil as $dados)
                                    <option value="{{ $dados->id }}">{{$dados->estado_civil}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" type="email" name="email" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Telefone</label>
                                <input class="form-control" type="text" name="telefone" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nascimento</label>
                                <input class="form-control" type="date" name="nascimento" placeholder="" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sexo</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sexo" value="M" required>Masculino
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="sexo" value="F" required>Feminino
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h4>Dependentes</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" id="btnAdd" class="btn btn-primary">Adicionar&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
                            <select class="form-control d-none" id="parentesco">
                                <option value="">Selecione</option>
                                @foreach($parentescos as $dados)
                                <option value="{{ $dados->id }}">{{$dados->parentesco}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center p-5">
                            <table class="table table-bordered" id="tblDependentes">
                                <thead style="background-color: #364756; color: #fff;">
                                    <tr class="text-center">
                                        <th width="30%">Nome</th>
                                        <th width="20%">CPF</th>
                                        <th width="10%">Nascimento</th>
                                        <th width="20%">Parentesco</th>
                                        <td width="5%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td colspan="6"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('contas') }}">
                                <button type="button" class="btn btn-primary" style="width:100px"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</button>
                            </a>&nbsp;
                            <input type="submit" class="btn btn-primary" style="width:100px" value="Enviar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link href="{{ url('assets/css/select2.css') }}" rel="stylesheet" />
<script type="text/javascript" src="{{ url('assets/js/scriptContas.js' )}}"></script>
<script src="{{ url('assets/js/plugins/select2.min.js') }}"></script>
@endsection