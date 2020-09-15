<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use App\Models\User;
use App\Models\StatusModel;
use App\Models\FuncionarioModel;

class UsuarioController extends Controller
{
    
    private $usuarios;
    private $status;
    private $funcionarios;

    public function __construct(){
        $this->usuarios = new User;
        $this->status = new StatusModel;
        $this->funcionarios = new FuncionarioModel;
    }

    public function index()
    {
        $usuarios=$this->usuarios->all()->where('id','<>',1);;
        return view('usuarios.lista',compact('usuarios'));
    }

    public function create()
    {
        $status=$this->status->all()->where('cod','<>',2)->sortby('status');
        $funcionarios=$this->funcionarios->all()->where('id','<>',1);
        return view('usuarios.novo', compact('status', 'funcionarios'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'login' => 'required|unique:usuario,username',
            'senha' => 'required',
            'confirmacao' => 'required|same:senha',
            'status' => 'required|in:0,1,2',
            'tipo' => 'required|in:0,1',
            'funcionario' => 'required|exists:funcionario,id|unique:usuario,fk_funcionario'
        ]);

        try{
            $this->usuarios->create([
                'username' => $request->login,
                'password' => bcrypt($request->senha),
                'tipo' => $request->tipo,
                'fk_status' => $request->status,
                'fk_funcionario' => $request->funcionario
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
        $usuarios=$this->usuarios->find($id);
        $status=$this->status->all()->where('cod','<>',2)->sortby('status');
        $funcionarios=$this->funcionarios->all()->where('id','<>',1);
        return view('usuarios.editar', compact('usuarios', 'status', 'funcionarios'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'login' => 'required|unique:usuario,username,'.$id,
            'senha' => 'required',
            'confirmacao' => 'required|same:senha',
            'status' => 'required|in:0,1,2',
            'tipo' => 'required|in:0,1',
            'funcionario' => 'required|exists:funcionario,id|unique:usuario,fk_funcionario,'.$id
        ]);

        try{
            $this->usuarios->find($id)->update([
                'username' => $request->login,
                'password' => bcrypt($request->senha),
                'tipo' => $request->tipo,
                'fk_status' => $request->status,
                'fk_funcionario' => $request->funcionario
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Editar'
            ]);
        }    
        
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);
    }

    public function destroy($id)
    {
        try {             
            $this->usuarios->destroy($id);
        }catch(QueryException $ex){ 
            return back()->with('error', 'Erro ao Excluir');
        }        
            
        return redirect('usuarios')->with('success', 'Excluído com sucesso!');
    }
}
