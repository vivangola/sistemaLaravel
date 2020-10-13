<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\MaterialModel;
use App\Models\MovimentoEstoqueModel;
use Session;

class EstoqueController extends Controller
{

    private $materiais;
    private $movimento;

    public function __construct(){
        $this->materiais = new MaterialModel;
        $this->movimento = new MovimentoEstoqueModel;
    }
    
    public function index()
    {
        $materiais = $this->materiais->all()->sortBy('material');
        return view('estoque.estoque', compact('materiais'));
    }
    
    public function create()
    {
        //
    }
    
    public function store(Request $request)
    {
        //
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'material' => 'required|numeric|exists:materiais,id',
            'quantidade' => 'required|numeric|gt:0',
            'operacao' => 'required|string|in:E,S',
            'observacao' => 'nullable|string'
        ]);

        $estoqueAtual = $this->materiais->find($id)->estoque;

        DB::beginTransaction();
        
        try{
            $this->materiais->find($id)->update([
                'estoque' => $estoqueAtual + ($request->operacao == 'E' ? $request->quantidade : $request->quantidade*-1),
            ]);
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao atualizar estoque!'
            ]);
        }   
        
        try{
            $this->movimento->create([
                'quantidade' => $request->quantidade,
                'usuario_id' => Session::get('user')['id'],
                'operacao' => ($request->operacao == 'E' ? 'Entrada' : 'Saida'),
                'tipo' => 'Movimento Estoque',
                'observacao' => $request->observacao,
                'material_id' => $id
            ]);            
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao salvar movimento de estoque!'
            ]);
        }    

        DB::commit();
        
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);
    }
    
    public function destroy($id)
    {
        //
    }
}
