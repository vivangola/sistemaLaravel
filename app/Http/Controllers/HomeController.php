<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaModel;
use App\Models\ObitoModel;
use App\Models\MesModel;
use DB;

class HomeController extends Controller
{

    private $contas;
    private $obitos;
    private $meses;

    public function __construct(){
        $this->contas = new ContaModel;
        $this->obitos = new ObitoModel;
        $this->meses = new MesModel;
    }

    public function index(){
        $contas = $this->contas->count();
        $ativas = $this->contas->where('tipo_status_id',1)->count();
        $debito = $this->contas->where('tipo_status_id',2)->count();
        $obitos = $this->obitos->count();

        $meses = $this->getMeses();
        $novasContas = $this->getNovasContas();
        $faturamento = $this->getFaturamento();

        return view('home',compact('contas','ativas','debito','obitos','meses','novasContas','faturamento'));
    }

    public function getMeses(){
        $array = [];
        $select = $this->meses->all();
        foreach($select as $dados){
            array_push($array, $dados->nome);
        }
        return json_encode($array);
    }

    public function getNovasContas(){
        $array = [];
        $select = $this->meses->selectRaw('meses.id as mes, count(b.id) as cont')
                                    ->leftjoin('contas as b', function($join){
                                        $join->on('meses.id', '=', DB::raw('month(b.created_at)'));
                                        $join->on('b.created_at', '>=', DB::raw('"'.date('Y').'-01-01"')); 
                                    })->groupBy('mes')->orderBy('mes')->get();
        foreach($select as $dados){
            array_push($array, $dados->cont);
        }
        return json_encode($array);
    }

    public function getFaturamento(){
        $array = [];
        $select = $this->meses->selectRaw('meses.id as mes, sum(b.valor) as soma')
                                    ->leftjoin('mensalidades as b', function($join){
                                        $join->on('meses.id', '=', DB::raw('month(b.data_pagamento)'));
                                        $join->on('b.data_pagamento', '>=', DB::raw('"'.date('Y').'-01-01"')); 
                                    })->groupBy('mes')->orderBy('mes')->get();
        foreach($select as $dados){
            array_push($array, $dados->soma);
        }
        return json_encode($array);
    }
}