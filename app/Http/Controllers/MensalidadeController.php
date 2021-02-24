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
        $mensalidades = $this->mensalidades->all();
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
        $mensalidade = $this->mensalidades->find($id);
        $formasPagamento = $this->formasPagamento->all();
        $data = date('Y-m-d');
        return view('mensalidades.editar',compact('mensalidade', 'data', 'formasPagamento'));
    }
    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
