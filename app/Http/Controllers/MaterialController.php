<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialModel;
use App\Models\CategoriaModel;

class MaterialController extends Controller
{
    
    protected $materiais;
    protected $categorias;

    public function __construct(){
        $this->materiais = new MaterialModel;
        $this->categorias = new CategoriaModel;
    }

    public function index()
    {
        $materiais = $this->materiais->all()->sortBy('material');
        return view('materiais.lista', compact('materiais'));
    }

    public function create()
    {
        $categorias = $this->categorias->all()->sortBy('categoria');
        return view('materiais.novo', compact('categorias'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'material' => 'required|string',
            'quantidade' => 'required|numeric',
            'categoria' => 'required|numeric|exists:categorias,id'
        ]);

        try{
            $this->materiais->create([
                'material' => $request->material,
                'modelo' => $request->modelo,
                'tamanho' => $request->tamanho,
                'descricao' => $request->descricao,
                'qtd_minima' => $request->quantidade,
                'estoque' => 0,
                'categoria_id' => $request->categoria
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Salvar'
            ]);
        }    
        
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);
    }

    public function show($id)
    {
        $material = $this->materiais->find($id);
        return json_encode($material);
    }

    public function edit($id)
    {
        $material = $this->materiais->find($id);
        $categorias = $this->categorias->all()->sortBy('categoria');
        return view('materiais.editar', compact('categorias','material'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'material' => 'required|string',
            'quantidade' => 'required|numeric',
            'categoria' => 'required|numeric|exists:categorias,id'
        ]);

        try{
            $this->materiais->find($id)->update([
                'material' => $request->material,
                'modelo' => $request->modelo,
                'tamanho' => $request->tamanho,
                'descricao' => $request->descricao,
                'qtd_minima' => $request->quantidade,
                'estoque' => 0,
                'categoria_id' => $request->categoria
            ]);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Editar'
            ]);
        }    
        
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);
    }

    public function destroy($id)
    {
        try{
            $this->materiais->destroy($id);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Excluir!'
            ]);
        }        
          
        return json_encode([
            'success'=> true,
            'msg' => 'Excluído com sucesso!'
        ]);
    }
}
