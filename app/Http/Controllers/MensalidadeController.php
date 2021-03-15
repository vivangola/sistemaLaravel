<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensalidadeModel;
use App\Models\FormasPagamentoModel;
use App\Models\ContaModel;
use DB;

class MensalidadeController extends Controller
{

    protected $mensalidades;
    protected $formasPagamento;
    protected $contas;

    public function __construct(){
        $this->mensalidades = new MensalidadeModel;
        $this->contas = new ContaModel;
        $this->formasPagamento = new FormasPagamentoModel;
    }
    
    public function index()
    {
        $contas = $this->contas->contasAtivas()->sortBy('cod');
        return view('mensalidades.lista', compact('contas'));
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
        
        $mensalidade = $this->mensalidades->where(['id' => $id, 'data_pagamento' => null])->first();
        $formasPagamento = $this->formasPagamento->all();
        $data = date('Y-m-d');
        
        if(!$mensalidade){
            return redirect('mensalidades');
        }else{
            return view('mensalidades.editar',compact('mensalidade', 'data', 'formasPagamento'));
        }
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'forma_pagamento' => 'required|numeric|exists:formas_pagamento,id',
            'data_pagamento' => 'required|date'
        ]);

        DB::beginTransaction();

        try{
            $this->mensalidades->find($id)->update([
                'formas_pagamento_id' => $request->forma_pagamento,
                'data_pagamento' => $request->data_pagamento
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Registrar Pagamento'
            ]);
        }    

        try{
            $contaID = $this->mensalidades->find($id)->conta_id;
            DB::statement('call atualizaDebito_sp('.$contaID.')');
        }catch(QueryException $ex){ 
            DB::rollback();
                return json_encode([
                    'success'=> false,
                    'msg' => 'Erro ao atualizar status!'
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
