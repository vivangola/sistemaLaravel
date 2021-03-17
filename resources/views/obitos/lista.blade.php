@extends('templates.template')
@section('title','Óbitos')

@section('titulo','ÓBITOS')
@section('icone','fa fa-user')

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="tile">
              <div class="tile-body">
                  <div class="row mr-4 mt-2">
                      <div class="text-right col-md-12">
                          <a href="/obitos/create">
                              <button class="btn btn-primary" style="width:100px">Novo &nbsp;<i class="fa fa-plus"></i></button>
                          </a>
                      </div>
                  </div>
                  <div class="row m-4">
                      <div class="col-md-12 table-responsive">
                          @csrf
                          <table class="table table-bordered table-striped" id="tblDados">
                              <thead style="background-color: #364756; color: #fff;" >
                                  <tr class="text-center">
                                      <th>Conta</th>
                                      <th>Titular</th>
                                      <th>Plano</th>
                                      <th>Falecido</th>
                                      <th>Data Falecimento</th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($obitos as $dados)
                                  <tr>
                                      <td align="center">{{ substr('0000'.$dados->conta->id, -4) }}</td>
                                      <td>{{ $dados->conta->titular->nome }}</td>
                                      <td align="center">{{ $dados->conta->plano->plano }}</td>
                                      <td align="center">{{ $dados->falecido()->nome }}</td>
                                      <td align="center">{{ $dados->created_at->format('d/m/Y') }}</td>
                                      <td align="center">
                                        <a href="{{url("obitos/$dados->id/edit")}}">
                                          <button class="btn btn-danger">Editar</button>
                                        </a>
                                      </td>
                                  </tr>
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