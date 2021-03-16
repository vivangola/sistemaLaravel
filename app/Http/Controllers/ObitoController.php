<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObitoModel;
use App\Models\ContaModel;
use App\Models\TitularModel;
use App\Models\DependenteModel;

class ObitoController extends Controller
{
    protected $obitos;
    protected $contas;
    protected $titular;
    protected $dependente;

    public function __construct(){
        $this->obitos = new ObitoModel;
        $this->contas = new ContaModel;
        $this->titular = new TitularModel;
        $this->dependente = new DependenteModel;
    }
    
    public function index()
    {
        $obitos = $this->obitos->all();
        return view('obitos.lista',compact('obitos'));
    }

    public function create()
    {
        $titulares = $this->contas->contasAtivas()->sortBy('nome');
        return view('obitos.novo', compact('titulares'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'conta' => 'required|numeric|exists:contas,id',
            //'falecido' => 'required|string|exists:titulares,cpf',
            'local_falecimento' => 'nullable|string',
            'data_falecimento' => 'required|date',
            'hora_falecimento' => 'nullable|date_format:H:i',
            'local_velorio' => 'nullable|string',
            'data_velorio' => 'nullable|date',
            'hora_velorio' => 'nullable|date_format:H:i',
            'local_enterro' => 'nullable|string',
            'data_enterro' => 'nullable|date',
            'hora_enterro' => 'nullable|date_format:H:i'
        ]);
        
        if(!$this->checkFalecido($request->falecido)){
            return json_encode([
                'success'=> false,
                'msg' => 'Falecido inválido, por favor tente novamente!'
            ]);
        }

        try{
            $this->obitos->create([
                'conta_id' => $request->conta,
                'cpf_falecido' => $request->falecido,
                'local_falecimento' => $request->local_falecimento,
                'data_falecimento' =>  $request->data_falecimento.' '.$request->hora_falecimento,
                'local_velorio' => $request->local_velorio,
                'data_velorio' => isset($request->hora_velorio) ? $request->data_velorio.' '.$request->hora_velorio : $request->data_velorio,
                'local_enterro' => $request->local_enterro,
                'data_enterro' => isset($request->data_enterro) ? $request->data_enterro.' '.$request->hora_enterro : $request->data_enterro,
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

    public function checkFalecido($cpf){
        $falecido = $this->titular->where('cpf', $cpf)->exists();
        if(!$falecido){
            $falecido = $this->dependente->where('cpf', $cpf)->exists();
        }
        if($falecido && $this->obitos->where('cpf_falecido', $cpf)->exists()){
            $falecido = false;
        }
        return $falecido;
    }

}
