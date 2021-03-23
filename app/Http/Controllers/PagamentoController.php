<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensalidadeModel;
use App\Models\FormasPagamentoModel;
use App\Models\ContaModel;
use App\Models\TitularModel;
use DB;

class PagamentoController extends Controller
{
    protected $mensalidades;
    protected $formasPagamento;
    protected $contas;
    protected $titular;

    public function __construct(){
        $this->mensalidades = new MensalidadeModel;
        $this->contas = new ContaModel;
        $this->formasPagamento = new FormasPagamentoModel;
        $this->titular = new TitularModel;
    }

    public function index()
    {
        return view('pagamentos.home');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->cpf = str_replace("-","",str_replace(".","",$request->cpf));
        $titular = $this->titular->where('cpf',$request->cpf)->first();
        if(!$titular){
            return redirect()->back()->withInput()->withErrors(['Titular não encontrado!']);  
        }else{
            if($this->contas->contasAtivas($titular->conta_id)->exists()){
                $mensalidades = $this->mensalidades->all()->where('conta_id', $titular->conta_id)->where('data_pagamento', null);
                return view('pagamentos.lista',compact('mensalidades'));
            }else{
                return redirect()->back()->withInput()->withErrors(['Conta inativa!']);  
            }
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $mensalidade = $this->mensalidades->where(['id' => $id, 'data_pagamento' => null])->first();
        $formasPagamento = $this->formasPagamento->all()->where('id',1);
        $data = date('Y-m-d');
        
        if(!$mensalidade){
            return redirect('pagamentos');
        }else{
            return view('pagamentos.editar',compact('mensalidade', 'data', 'formasPagamento'));
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
