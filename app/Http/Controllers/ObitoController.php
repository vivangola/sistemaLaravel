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
        
        if(!$this->checkFalecido($request->falecido, false)){
            return json_encode([
                'success'=> false,
                'msg' => 'Falecido inválido, por favor tente novamente!'
            ]);
        }
        
        if($this->contas->find($request->conta)->titular->cpf == $request->falecido && $request->inativa){
            $this->inativarConta($request->conta);
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
        $obito = $this->obitos->find($id);
        $conta = $this->contas->find($obito->conta_id);
        $obito->hora_falecimento = isset($obito->data_falecimento) ? date_format(date_create($obito->data_falecimento), 'H:i') : null;
        $obito->data_falecimento = isset($obito->data_falecimento) ? date_format(date_create($obito->data_falecimento), 'Y-m-d') : null;
        $obito->hora_velorio = isset($obito->data_velorio) ? date_format(date_create($obito->data_velorio), 'H:i') : null;
        $obito->data_velorio = isset($obito->data_velorio) ? date_format(date_create($obito->data_velorio), 'Y-m-d') : null;
        $obito->hora_enterro = isset($obito->data_enterro) ? date_format(date_create($obito->data_enterro), 'H:i') : null;
        $obito->data_enterro = isset($obito->data_enterro) ? date_format(date_create($obito->data_enterro), 'Y-m-d') : null;
        return view('obitos.editar', compact('obito','conta'));
    }
    
    public function update(Request $request, $id)
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

        if(!$this->checkFalecido($request->falecido, true)){
            return json_encode([
                'success'=> false,
                'msg' => 'Falecido inválido, por favor tente novamente!'
            ]);
        }

        if($this->contas->find($request->conta)->titular->cpf == $request->falecido && $request->inativa){
            $this->inativarConta($request->conta);
        }

        try{
            $this->obitos->find($id)->update([
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
    
    public function destroy($id)
    {
        //
    }

    public function checkFalecido($cpf, $update){

        $falecido = $this->titular->where('cpf', $cpf)->exists();

        if(!$falecido){
            $falecido = $this->dependente->where('cpf', $cpf)->exists();
        }

        if(!$update && $falecido && $this->obitos->where('cpf_falecido', $cpf)->exists()){
            $falecido = false;
        }

        return $falecido;
    }

    public function inativarConta($conta){
        try{
            $this->contas->find($conta)->update([
                'tipo_status_id' => 0,
            ]);            
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Inativar a Conta!'
            ]);
        }    
    }

}
