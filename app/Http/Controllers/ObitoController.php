<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObitoModel;

class ObitoController extends Controller
{
    protected $obitos;

    public function __construct(){
        $this->obitos = new ObitoModel;
    }
    
    public function index()
    {
        $obitos = $this->obitos->all();
        return view('obitos.lista',compact('obitos'));
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
