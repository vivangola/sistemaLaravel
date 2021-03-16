<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaModel;
use App\Models\ObitoModel;
use Auth;

class HomeController extends Controller
{

    private $contas;
    private $obitos;

    public function __construct(){
        $this->contas = new ContaModel;
        $this->obitos = new ObitoModel;
    }

    public function index(){
        $contas = $this->contas->count();
        $ativas = $this->contas->where('tipo_status_id',1)->count();
        $debito = $this->contas->where('tipo_status_id',2)->count();
        $obitos = $this->obitos->count();
        return view('home',compact('contas','ativas','debito','obitos'));
    }
}
