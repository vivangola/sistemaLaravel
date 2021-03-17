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
use App\Models\ObitoModel;
use DB;

class ContaController extends Controller
{
    
    private $contas;
    private $estado;
    private $status;
    private $civil;
    private $planos;
    private $titulares;
    private $dependentes;
    private $parentescos;

    public function __construct(){
        $this->contas = new ContaModel;
        $this->titulares = new TitularModel;
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
        //conta
        $this->validate($request,[
            'status' => 'required|numeric|exists:tipo_status,id',
            'plano' => 'required|numeric|exists:planos,id'
        ]);

        DB::beginTransaction();

        try{
            $contaID=$this->contas->create([
                'tipo_status_id' => $request->status,
                'plano_id' => $request->plano,
            ])->id;            
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Salvar Conta!'
            ]);
        }    

        // titulares
        $this->validate($request,[
            'cpf' => 'required|string|unique:titulares',
            'rg' => 'required|string|unique:titulares',
            'nome' => 'required|string',
            'sexo' => 'required|in:M,F',
            'telefone' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'civil' => 'required|numeric|exists:estado_civil,id',
            'endereco' => 'required|string',
            'numero' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string|exists:estados,uf', 
            'cep' => 'required|string',
            'nascimento' => 'required|date',
        ]);
           
        try{
            $titularID=$this->titulares->create([
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'nome' => $request->nome,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'estado_civil_id' => $request->civil,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado_uf' => $request->estado,
                'cep' => $request->cep,
                'nascimento' => $request->nascimento,
                'conta_id' => $contaID
            ])->id;
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Salvar Titular!'
            ]);
        }    

        //dependentes
        if($request->dcpf){
            if(count($request->dcpf) > $this->contas->find($contaID)->plano->dependentes){
                DB::rollback();
                return json_encode([
                    'success'=> false,
                    'msg' => 'Quantidade de dependentes inválida de acordo com o plano!'
                ]);
            }

            $result=$this->validate($request,[
                'dnome.*' => 'required|string',
                'dcpf.*' => 'required|string|unique:dependentes,cpf',
                'dnascimento.*' => 'required|date',
                'parentesco.*' => 'required|numeric|exists:parentescos,id'
            ]);

            foreach($request->dcpf as $key => $dados){
                try{
                    $this->dependentes->create([
                        'cpf' => $request->dcpf[$key],
                        'nome' => $request->dnome[$key],
                        'nascimento' => $request->dnascimento[$key],
                        'parentesco_id' => $request->parentesco[$key],
                        'titular_id' => $titularID
                    ]);
                }catch(QueryException $ex){ 
                    DB::rollback();
                    return json_encode([
                        'success'=> false,
                        'msg' => 'Erro ao Salvar o Dependente '.$request->nome.'!'
                    ]);
                }  
            }
        }

        try{
            DB::statement('call gerarMensalidade_sp('.$contaID.')');
            DB::statement('call atualizaDebito_sp('.$contaID.')');
        }catch(QueryException $ex){ 
            DB::rollback();
                return json_encode([
                    'success'=> false,
                    'msg' => 'Erro ao Gerar Mensalidade!'
            ]);
        }  

        DB::commit();
       
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);

    }

    public function show($id)
    {
        $titular = $this->contas->find($id)->titular;
        $dependentes = $this->contas->find($id)->titular->dependentes->all();
        $obitos = new ObitoModel;
        
        $pessoas = [];
        if(!$obitos->where('cpf_falecido',$titular->cpf)->exists()){
            array_push($pessoas,['cpf' => $titular->cpf, 'nome' => $titular->nome]);
        }

        if($dependentes){
            foreach($dependentes as $dados){
                if(!$obitos->where('cpf_falecido',$dados->cpf)->exists()){
                    array_push($pessoas, ['cpf' => $dados->cpf, 'nome' => $dados->nome]);
                }
            }
        }
        return json_encode($pessoas);
    }

    public function edit($id)
    {
        $conta = $this->contas->find($id);
        $estados = $this->estados->all();
        $status = $this->status->all()->sortby('status');
        $civil = $this->civil->all()->sortby('estado_civil');
        $planos = $this->planos->all()->sortby('plano');
        $parentescos = $this->parentescos->all()->sortby('parentesco');
        return view('contas.editar', compact('conta','estados','status','civil','planos','parentescos'));
    }

    public function update(Request $request, $id)
    {   
        //conta
        $this->validate($request,[
            'status' => 'required|numeric|exists:tipo_status,id',
            'plano' => 'required|numeric|exists:planos,id'
        ]);

        DB::beginTransaction();

        try{
            $this->contas->find($id)->update([
                'tipo_status_id' => $request->status,
                'plano_id' => $request->plano,
            ]);            
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Salvar Conta!'
            ]);
        }    

        // titulares
        $titularID = $this->titulares->where('conta_id', $id)->first()->id;

        $this->validate($request,[
            'cpf' => 'required|string|unique:titulares,id,'.$titularID,
            'rg' => 'required|string|unique:titulares,id,'.$titularID,
            'nome' => 'required|string',
            'sexo' => 'required|in:M,F',
            'telefone' => 'required|string',
            'email' => 'required|email:rfc,dns',
            'civil' => 'required|numeric|exists:estado_civil,id',
            'endereco' => 'required|string',
            'numero' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'estado' => 'required|string|exists:estados,uf', 
            'cep' => 'required|string',
            'nascimento' => 'required|date',
        ]);
           
        try{
            $this->titulares->find($titularID)->update([
                'cpf' => $request->cpf,
                'rg' => $request->rg,
                'nome' => $request->nome,
                'sexo' => $request->sexo,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'estado_civil_id' => $request->civil,
                'endereco' => $request->endereco,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'estado_uf' => $request->estado,
                'cep' => $request->cep,
                'nascimento' => $request->nascimento
            ]);
        }catch(QueryException $ex){ 
            DB::rollback();
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Salvar Titular!'
            ]);
        }    

        //dependentes
        if($request->dcpf){
            if(count($request->dcpf) > $this->contas->find($id)->plano->dependentes){
                DB::rollback();
                return json_encode([
                    'success'=> false,
                    'msg' => 'Quantidade de dependentes inválida de acordo com o plano!'
                ]);
            }

            try {             
                $this->dependentes->where('titular_id', $titularID)->delete();
            }catch(QueryException $ex){ 
                DB::rollback();
                return back()->with('error', 'Erro ao configurar dependentes');
            }        
            
            $result=$this->validate($request,[
                'dnome.*' => 'required|string',
                'dcpf.*' => 'required|string|unique:dependentes,cpf',
                'dnascimento.*' => 'required|date',
                'parentesco.*' => 'required|numeric|exists:parentescos,id'
            ]);

            foreach($request->dcpf as $key => $dados){
                try{
                    $this->dependentes->create([
                        'cpf' => $request->dcpf[$key],
                        'nome' => $request->dnome[$key],
                        'nascimento' => $request->dnascimento[$key],
                        'parentesco_id' => $request->parentesco[$key],
                        'titular_id' => $titularID
                    ]);
                }catch(QueryException $ex){ 
                    DB::rollback();
                    return json_encode([
                        'success'=> false,
                        'msg' => 'Erro ao Salvar o Dependente '.$request->nome.'!'
                    ]);
                }  
            }
        }
        
        DB::commit();
       
        return json_encode([
            'success'=> true,
            'msg' => ''
        ]);

    }

    public function destroy($id)
    {
        try {             
            $this->contas->destroy($id);
        }catch(QueryException $ex){ 
            return json_encode([
                'success'=> false,
                'msg' => 'Erro ao Excluir!'
            ]);
            return back()->with('error', 'Erro ao Excluir');
        }        
          
        return json_encode([
            'success'=> true,
            'msg' => 'Excluído com sucesso!'
        ]);
    }
}
