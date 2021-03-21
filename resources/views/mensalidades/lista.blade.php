@extends('templates.template')
@section('title','Mensalidades')

@section('titulo','MENSALIDADES')
@section('icone','fa fa-user')

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="tile">
              <div class="tile-body">
                  <!--div class="row mr-4 mt-2">
                      <div class="text-right col-md-12">
                          <a href="/contas/create">
                              <button class="btn btn-primary" style="width:100px">Novo &nbsp;<i class="fa fa-plus"></i></button>
                          </a>
                      </div>
                  </div-->
                  <div class="row m-4">
                      <div class="col-md-12 table-responsive">
                          @csrf
                          <table class="table table-bordered table-striped" id="tblDados">
                              <thead style="background-color: #364756; color: #fff;" >
                                  <tr class="text-center">
                                      <th>Cod.</th>
                                      <th>Titular</th>
                                      <th>Telefone</th>
                                      <th>Status</th>
                                      <th>Plano</th>
                                      <th>Valor</th>
                                      <th>Período</th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($contas as $dados)
                                    @foreach($dados->mensalidadesDebito()->get() as $mensalidade)
                                        <tr>
                                            <td align="center">{{ substr('0000'.$dados->id, -4) }}</td>
                                            <td>{{$dados->titular->nome}}</td>
                                            <td align="center">{{$dados->titular->telefone}}</td>
                                            <td align="center">
                                                @if($dados->status->id == 1)
                                                    @php $btn = 'success'; @endphp
                                                @elseif($dados->status->id == 2)
                                                    @php $btn = 'warning'; @endphp
                                                @else
                                                    @php $btn = 'danger'; @endphp
                                                @endif
                                                <button type="button" class='btn btn-{{$btn}} btn-status'>
                                                        {{$dados->status->status}}
                                                </button>
                                            </td>
                                            <td align="center">{{$dados->plano->plano}}</td>
                                            <td align="center">{{'R$ '.number_format($dados->plano->mensalidade,2,',','')}}</td>
                                            <td align="center">{{$mensalidade->periodo}}</td>
                                            <td align="center">
                                                <a href="{{url("mensalidades/$mensalidade->id/edit")}}">
                                                <button class="btn btn-danger">Pagar</button>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                @endforeach
                              </tbody>
                          </table>
                      </div>
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