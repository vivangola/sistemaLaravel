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
        $status=$this->status->all()->where('id','<>',2)->sortby('status');
        $funcionarios=$this->funcionarios->all()->where('id','<>',1);
        return view('usuarios.novo', compact('status', 'funcionarios'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'login' => 'required|unique:usuarios,username',
            'senha' => 'required',
            'confirmacao' => 'required|same:senha',
            'status' => 'required|numeric|exists:tipo_status,id',
            'tipo' => 'required|in:0,1',
            'funcionario' => 'required|exists:funcionarios,id|unique:usuarios,funcionario_id'
        ]);

        try{
            $this->usuarios->create([
                'username' => $request->login,
                'password' => bcrypt($request->senha),
                'tipo' => $request->tipo,
                'tipo_status_id' => $request->status,
                'funcionario_id' => $request->funcionario
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
        $usuario=$this->usuarios->find($id);
        $status=$this->status->all()->where('id','<>',2)->sortby('status');
        $funcionarios=$this->funcionarios->all()->where('id','<>',1);
        return view('usuarios.editar', compact('usuario', 'status', 'funcionarios'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'login' => 'required|unique:usuarios,username,'.$id,
            'senha' => session('user.tipo') == 0 ? 'required' : '',
            'confirmacao' => session('user.tipo') == 0 ? 'required|same:senha' : '',
            'status' => 'required|numeric|exists:tipo_status,id',
            'tipo' => session('user.tipo') == 1 ? 'required|in:0,1' : '',
            'funcionario' => 'required|exists:funcionarios,id|unique:usuarios,funcionario_id,'.$id
        ]);

        try{
            if(session('user.id') != $id){
                $this->usuarios->find($id)->update([
                    'username' => $request->login,
                    'tipo' => $request->tipo,
                    'tipo_status_id' => $request->status,
                    'funcionario_id' => $request->funcionario
                ]);
            }else{
                $this->usuarios->find($id)->update([
                    'username' => $request->login,
                    'tipo' => isset($request->tipo) ? $request->tipo : 0,
                    'password' => bcrypt($request->senha),
                    'tipo_status_id' => $request->status,
                    'funcionario_id' => $request->funcionario
                ]);
            }
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
