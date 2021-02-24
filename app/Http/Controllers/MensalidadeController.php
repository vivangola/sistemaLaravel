<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MensalidadeModel;

class MensalidadeController extends Controller
{

    protected $mensalidades;

    public function __construct(){
        $this->mensalidades = new MensalidadeModel;
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
}
