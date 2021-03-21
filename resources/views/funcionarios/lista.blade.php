@extends('templates.template')
@section('title','Funcionários')

@section('titulo','FUNCIONÁRIOS')
@section('icone','fa fa-user')

@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="tile">
              <div class="tile-body">
                  <div class="row mr-4 mt-2">
                      <div class="text-right col-md-12">
                          <a href="/funcionarios/create">
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
                                      <th>Nome</th>
                                      <th>Cargo</th>
                                      <th>Telefone</th>
                                      <th>Email</th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach($funcionarios as $dados)
                                  <tr>
                                      <td>{{$dados->nome}}</td>
                                      <td>{{$dados->cargo}}</td>
                                      <td>{{$dados->telefone}}</td>
                                      <td>{{$dados->email}}</td>
                                      <td align="center">
                                        <a href="{{url("funcionarios/$dados->id/edit")}}">
                                          <button class="btn btn-primary">Editar</button>
                                        </a>
                                      </td>
                                      <td align="center">
                                        {!! Form::open(['action' => ['FuncionarioController@destroy', $dados->id], 'method'=> 'POST', 'class' => 'alter']) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::submit('Excluir', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
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