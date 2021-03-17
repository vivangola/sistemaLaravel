<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\EmprestimoModel;
use App\Models\ContaModel;
use App\Models\TitularModel;
use App\Models\MaterialModel;
use App\Models\MovimentoEstoqueModel;

class EmprestimoController extends Controller
{
    
    private $emprestimos;
    private $titulares;
    private $materiais;
    private $movimento;

    public function __construct(){
        $this->emprestimos = new EmprestimoModel;
        $this->titulares = new TitularModel;
        $this->materiais = new MaterialModel;
        $this->movimento = new MovimentoEstoqueModel;
        $this->conta = new ContaModel;
    }

    public function index()
    {
        $emprestimos = $this->emprestimos->all()->where('quantidade','>',0)->sortBy('created_at');
        return view('emprestimos.lista', compact('emprestimos'));
    }
    
    public function create()
    {
        $titulares = $this->conta->contasAtivas()->sortBy('nome');
        $materiais = $this->materiais->all()->where('estoque','>', 0)->sortBy('material');
        return view('emprestimos.novo', compact('titulares','materiais'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'material' => 'required|numeric|exists:materiais,id',
            'conta' => 'required|numeric|exists:contas,id',
            'quantidade' => 'required|numeric|gt:0'
        ]);
        
        $estoqueAtual = $this->materiais->find($request->material)->estoque;

        if($request->quantidade > $estoqueAtual){
            return json_encode([
                'success'=> false,
                'msg' => 'Quantidade maior que estoque disponível!'
            ]);
        }

        DB::beginTransaction();

        try{
            $id=$this->emprestimos->create([
                'quantidade' => $request->quantidade,
                'conta_id' => $request->conta,
                'material_id' => $request->material
            ])->id;
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao salvar empréstimo!'
            ]);
        }   
        
        try{
            $this->materiais->find($request->material)->update([
                'estoque' => $estoqueAtual - $request->quantidade,
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
                'operacao' => 'Saida',
                'tipo' => 'Emprestimo',
                'emprestimo_id' => $id,
                'material_id' => $request->material,
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
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        $emprestimo = $this->emprestimos->find($id);
        if($emprestimo->quantidade == 0){
            return redirect('emprestimos');
        }
        $material = $this->materiais->find($emprestimo->material_id);
        $titular = $this->conta->find($emprestimo->conta_id)->titular;
        return view('emprestimos.editar', compact('emprestimo','material','titular'));
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'quantidade' => 'required|numeric|gt:0'
        ]);
        
        $emprestimo = $this->emprestimos->find($id);
        $material = $this->materiais->find($emprestimo->material_id);

        if($request->quantidade > $emprestimo->quantidade){
            return json_encode([
                'success'=> false,
                'msg' => 'Quantidade devolvida maior que quantidade emprestada!'
            ]);
        }

        DB::beginTransaction();

        try{
            $emprestimo->update([
                'quantidade' => $emprestimo->quantidade - $request->quantidade,
            ]);
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao salvar devolução!'
            ]);
        }   
        
        try{
            $material->update([
                'estoque' => $material->estoque + $request->quantidade,
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
                'operacao' => 'Entrada',
                'tipo' => 'Devolucao',
                'emprestimo_id' => $id,
                'material_id' => $emprestimo->material_id,
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
