<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanoModel;
use App\Models\StatusModel;

class PlanoController extends Controller
{

    private $planos;
    private $status;

    public function __construct(){
        $this->planos = new PlanoModel;
        $this->status = new StatusModel;
    }

    public function index()
    {
        $planos = $this->planos->all()->sortByDesc('tipo_status_id');
        return view('planos.lista', compact('planos'));
    }
    
    public function create()
    {
        $status=$this->status->all()->where('id','<>',2)->sortBy('status');
        return view('planos.novo', compact('status'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'plano' => 'required',
            'mensalidade' => 'required|numeric',
            'dependentes' => 'required|numeric',
            'carencia' => 'required|numeric',
            'status' => 'required|numeric|exists:tipo_status,id'
        ]);

        try{
            $this->planos->create([
                'plano' => $request->plano,
                'mensalidade' => $request->mensalidade,
                'dependentes' => $request->dependentes,
                'carencia' => $request->carencia,
                'tipo_status_id' => $request->status
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
        $planos = $this->planos->find($id);
        return json_encode($planos);
    }

    public function edit($id)
    {
        $plano = $this->planos->find($id);
        $status=$this->status->all()->where('id','<>',2)->sortBy('status');
        return view('planos.editar', compact('plano','status'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'plano' => 'required',
            'mensalidade' => 'required|numeric',
            'dependentes' => 'required|numeric',
            'carencia' => 'required|numeric',
            'status' => 'required|numeric|exists:tipo_status,id'
        ]);

        try{
            $this->planos->find($id)->update([
                'plano' => $request->plano,
                'mensalidade' => $request->mensalidade,
                'dependentes' => $request->dependentes,
                'carencia' => $request->carencia,
                'tipo_status_id' => $request->status
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Editar'
            ]);
        }    
        
        return json_encode([
            'success'=> true,
            'msg' => 'Alterado com sucesso!'
        ]);
    }

    public function destroy($id)
    {
        try {             
            $this->planos->destroy($id);
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
