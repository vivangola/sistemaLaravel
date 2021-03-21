<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\EstadoModel;
use App\Models\FuncionarioModel;
use Redirect;

class FuncionarioController extends Controller
{
    private $funcionario;
    private $estados;

    public function __construct(){
        $this->funcionario = new FuncionarioModel;
        $this->estados = new EstadoModel;
    }

    public function index()
    {
        $funcionarios = $this->funcionario->all()->where('id','<>',1);
        return view('funcionarios.lista', compact('funcionarios'));
    }

    public function create()
    {
        $estados = $this->estados->all();
        return view('funcionarios.novo', compact('estados'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'cpf' => 'required|string|unique:funcionarios',
            'nome' => 'required|string',
            'sexo' => 'nullable|in:M,F',
            'email' => 'nullable|email:rfc,dns',
            'nascimento' => 'nullable|date',
            'estado' => 'nullable|string|exists:estados,uf'
        ]);

        try{
            $this->funcionario->create([
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'nome' => $request->nome,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'cargo' => $request->cargo,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado_uf' => $request->estado,
                'cep' => $request->cep,
                'nascimento' => $request->nascimento
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Salvar'
            ]);
        }    
        
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $funcionario = $this->funcionario->find($id);
        $estados = $this->estados->all();
        return view('funcionarios.editar', compact('funcionario', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'cpf' => 'required|unique:funcionarios,cpf,'.$id,
            'nome' => 'required|string',
            'sexo' => 'nullable|in:M,F',
            'email' => 'nullable|email:rfc,dns',
            'nascimento' => 'nullable|date'
        ]);

        try {
            $this->funcionario->find($id)->update([
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'nome' => $request->nome,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'cargo' => $request->cargo,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado_uf' => $request->estado,
                'cep' => $request->cep,
                'nascimento' => $request->nascimento
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Editar'
            ]);
        }     
        
        return json_encode([
            'success'=> true,
            'msg' => 'Salvo com sucesso!'
        ]);
                    
    }

    public function destroy($id)
    {
        try {             
            $this->funcionario->destroy($id);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Excluir!'
            ]);
        }        
          
        return json_encode([
            'success'=> true,
            'msg' => 'Excluído com sucesso!'
        ]);
    }
}
