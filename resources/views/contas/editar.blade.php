@extends('templates.template')
@section('title','Contas')

@section('titulo','CONTAS')
@section('icone','fa fa-users')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <form name="frmNovo" class='alter' method="POST" action="{{ url("contas/$conta->id") }}">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <h3 class="tile-title">Editar Contas</h3>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                        <label class="control-label">Código</label>
                        <input class="text-center form-control" type="text" id="cod" name="cod" value="{{ substr('0000'.$conta->id, -4) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="status">
                                @foreach($status as $dados)
                                <option value="{{$dados->id}}" @if($conta->tipo_status_id == $dados->id) selected @endif>{{$dados->status}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Planos</h4>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Plano</label>
                            <select class="form-control select2" id="plano" name="plano" required>
                                @foreach($planos as $dados)
                                <option value="{{$dados->id}}" @if($conta->plano_id == $dados->id) selected @endif>{{$dados->plano}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="previous" value="{{ $conta->plano_id }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Mensalidade</label>
                            <input class="form-control" type="text" id="mensalidade" name="mensalidade" value="{{ $conta->plano->mensalidade }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Carência</label>
                            <input class="form-control" type="text" id="carencia" name="carencia" value="{{ $conta->plano->carencia }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Qtd. Dependentes</label>
                            <input class="form-control" type="text" id="qtd" name="qtd" value="{{ $conta->plano->dependentes }}" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <h4>Titular</h4>
                <hr>
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input class="form-control titular" type="text" name="nome" placeholder="" value="{{ $conta->titular->nome }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CPF</label>
                                <input class="form-control titular" type="text" name="cpf" placeholder="" maxlength="14" value="{{ $conta->titular->cpf }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">RG</label>
                                <input class="form-control titular" type="text" name="rg" placeholder="" value="{{ $conta->titular->rg }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label">Endereço</label>
                                <input class="form-control titular" type="text" name="endereco" placeholder="" value="{{ $conta->titular->endereco }}" required>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label class="control-label">Número</label>
                                <input class="form-control titular" type="text" name="numero" placeholder="" value="{{ $conta->titular->numero }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Bairro</label>
                                <input class="form-control titular" type="text" name="bairro" placeholder="" value="{{ $conta->titular->bairro }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Cidade</label>
                                <input class="form-control titular" type="text" name="cidade" placeholder="" value="{{ $conta->titular->cidade }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado</label>
                                <select class="form-control titular" name="estado" required>
                                    @foreach($estados as $estado)
                                    <option value="{{$estado->uf}}" @if($conta->titular->estado_uf == $estado->uf) selected @endif >{{$estado->estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">CEP</label>
                                <input class="form-control titular" type="text" name="cep" placeholder="" maxlength="9" value="{{ $conta->titular->cep }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Estado Civil</label>
                                <select class="form-control titular" name="civil" required>
                                    @foreach($civil as $dados)
                                    <option value="{{ $dados->id }}" @if($conta->titular->estado_civil_id == $dados->id) selected @endif >{{$dados->estado_civil}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control titular" type="email" name="email" placeholder="" value="{{ $conta->titular->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Telefone</label>
                                <input class="form-control titular" type="text" name="telefone" placeholder="" value="{{ $conta->titular->telefone }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nascimento</label>
                                <input class="form-control titular" type="date" name="nascimento" placeholder="" value="{{ $conta->titular->nascimento }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Sexo</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input titular" type="radio" name="sexo" value="M" @if($conta->titular->sexo == 'M') checked @endif required>Masculino
                                    </label>
                                    <br>
                                    <label class="form-check-label">
                                        <input class="form-check-input titular" type="radio" name="sexo" value="F" @if($conta->titular->sexo == 'F') checked @endif required>Feminino
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
                                        <td width="5%">Tornar Titular</td>
                                        <td width="5%">Excluir</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($conta->titular->dependentes as $dados)
                                    <tr class="text-center">
                                        <td><input type="text" class="text-center form-control" name="dnome[]" value="{{ $dados->nome }}" required></td>
                                        <td><input type="text" class="text-center form-control" name="dcpf[]" value="{{ $dados->cpf }}" required></td>
                                        <td><input type="date" class="text-center form-control" name="dnascimento[]" value="{{ $dados->nascimento }}" required></td>
                                        <td><select class="text-center form-control" name="parentesco[]">
                                        @foreach($parentescos as $parentesco)
                                        <option value="{{ $parentesco->id }}" @if($dados->parentesco_id == $parentesco->id) selected @endif>{{$parentesco->parentesco}}</option>
                                        @endforeach
                                        </select></td>
                                        <td>@if ($dados->idade() >= 18)
                                                <button class='btn btn-primary' type='button' value='Tornar Titular' onclick='tornarTitular(this)'><i class='fa fa-arrow-up'></i></button>
                                            @endif
                                        </td>
                                        <td><button class='btn btn-danger' type='button' value='Excluir' onclick='removeRow(this)'><i class='fa fa-trash'></i></button></td>
                                    </tr>
                                    @endforeach
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
                            <a href="{{ '/documents/Contrato.docx' }}">
                                <button type="button" class="btn btn-primary" style="width:120px"><i class="fa fa-file"></i>&nbsp;Contrato</button>
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
<script>
    $('.select2').select2();
</script>
@endsection