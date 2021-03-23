@extends('templates.template2')
@section('title','Mensalidades')

@section('titulo','MENSALIDADES')
@section('icone','fa fa-user')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="row m-4">
                    <div class="col-md-12 table-responsive">
                        @csrf
                        <table class="table table-bordered table-striped" id="tblDados">
                            <thead style="background-color: #364756; color: #fff;" >
                                <tr class="text-center">
                                    <th>Cod.</th>
                                    <th>Titular</th>
                                    <th>Plano</th>
                                    <th>Valor</th>
                                    <th>Período</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($mensalidades as $dados)
                                <tr>
                                    <td align="center">{{ substr('0000'.$dados->conta->id, -4) }}</td>
                                    <td>{{$dados->conta->titular->nome}}</td>
                                    <td align="center">{{$dados->conta->plano->plano}}</td>
                                    <td align="center">{{'R$ '.number_format($dados->conta->plano->mensalidade,2,',','')}}</td>
                                    <td align="center">{{$dados->periodo}}</td>
                                    <td align="center">
                                        <a href="{{url("pagamentos/$dados->id/edit")}}">
                                            <button class="btn btn-danger">Pagar</button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="{{ url('pagamentos') }}">
                        <button type="button" class="btn btn-primary" style="width:200px"><i class="fa fa-arrow-left"></i>&nbsp;Voltar</button>
                    </a>&nbsp;
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ url('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $('#tblDados').DataTable({
        'info': false,
        "language": {
            "url": "{{ url('assets/js/plugins/dataTablePTBR.json') }}"
        }
    });
</script>
@endsection