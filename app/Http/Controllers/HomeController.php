<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContaModel;
use Auth;
class HomeController extends Controller
{

    private $contas;

    public function __construct(){
        $this->contas = new ContaModel;
    }

    public function index(){
        $contas = $this->contas->count();
        $ativas = $this->contas->where('tipo_status_id',1)->count();
        $debito = $this->contas->where('tipo_status_id',2)->count();
        $obitos = 0;
        return view('home',compact('contas','ativas','debito','obitos'));
    }
}
