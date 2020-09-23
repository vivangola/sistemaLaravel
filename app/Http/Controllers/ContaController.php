<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaModel;
use App\Models\EstadoModel;
use App\Models\StatusModel;
use App\Models\EstadoCivilModel;
use App\Models\ParentescoModel;
use App\Models\PlanoModel;
use App\Models\TitularModel;
use App\Models\DependenteModel;

class ContaController extends Controller
{
    
    private $contas;
    private $estado;
    private $status;
    private $civil;
    private $planos;
    private $titular;
    private $dependentes;
    private $parentescos;

    public function __construct(){
        $this->contas = new ContaModel;
        $this->titular = new TitularModel;
        $this->dependentes = new DependenteModel;
        $this->estados = new EstadoModel;
        $this->status = new StatusModel;
        $this->civil = new EstadoCivilModel;
        $this->planos = new PlanoModel;
        $this->parentescos = new ParentescoModel;
    }
    
    public function index()
    {
        $contas = $this->contas->all();
        return view('contas.lista', compact('contas'));
    }

    public function create()
    {
        $estados = $this->estados->all();
        $status = $this->status->all()->sortby('status');
        $civil = $this->civil->all()->sortby('estado_civil');
        $planos = $this->planos->all()->sortby('plano');
        $parentescos = $this->parentescos->all()->sortby('parentesco');
        return view('contas.novo', compact('estados', 'status', 'civil','planos','parentescos'));
    }

    public function store(Request $request)
    {
        dd($request);
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
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getPlanos($request){
        dd($request);

    }
}
