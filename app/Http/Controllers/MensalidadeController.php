<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensalidadeModel;
use App\Models\FormasPagamentoModel;

class MensalidadeController extends Controller
{

    protected $mensalidades;
    protected $formasPagamento;

    public function __construct(){
        $this->mensalidades = new MensalidadeModel;
        $this->formasPagamento = new FormasPagamentoModel;
    }
    
    public function index()
    {
        $mensalidades = $this->mensalidades->all()->where('data_pagamento',null);
        return view('mensalidades.lista', compact('mensalidades'));
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
        $mensalidade = $this->mensalidades->find($id)->where('data_pagamento',null)->first();
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
