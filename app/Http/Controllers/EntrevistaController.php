<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrevista;
use DB;
class EntrevistaController extends Controller
{
     private $ent;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
            'ent_entrevistado.required' => "É obrigatorio preechimento do campo ENTREVISTADO",
            'ent_entrevistador.required'=>"É obrigatorio preechimento do campo ENTREVISTADOR",
            'ent_data.required'=>"É obrigatorio preechimento do campo DATA",
            'ent_empresa.required'=>"É obrigatorio preechimento do campo EMPRESA",
            'ent_horario.required'=>"É obrigatorio preechimento do campo HORARIO",
            'ent_end_cidade.required'=> "É obrigatorio preechimento do campo CIDADE",
            'ent_end_estado.required'=> "É obrigatorio preechimento do campo ESTADO",
            'ent_end_bairro.required'=> "É obrigatorio preechimento do campo BAIRRO",
            'ent_end_rua.required'=> "É obrigatorio preechimento do campo RUA",
            'ent_end_numero.required'=>"É obrigatorio preechimento do campo NÚMERO",
        ];
    
    public function __construct(Entrevista $f){
        $this->ent=$f;        
    }
    
    public function index(Request $request){        
        $title="SISSAR Painel Entrevista";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosEnt = $this->ent->where("ent_status",'1')
                                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                                ->orderBy('ent_entrevistado', 'asc')
                                ->get(); 
            
            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosEnt = $this->ent->where("ent_status",'1')->orderBy('ent_entrevistado', 'asc')->get();                                
        }       
        
        return view("crud-entrevista/entrevistaList",compact("dadosEnt",
                                                                "title",
                                                                "valor_filter_text",
                                                                "valor_filter_campo"));
    }
    
    public function show($ent_cod){
        $title="SISSAR Visualização Entrevista";            
        
        $states = DB::select('select * from estados');//pesquisando estados do Brasil no banco
        
        $dadosEnts = $this->ent->where("ent_cod",$ent_cod)->get();   
        foreach($dadosEnts as $d){
            $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $d['ent_cod'],
                    'entrevistado' => $d['ent_entrevistado'],
                    'entrevistador'=> $d['ent_entrevistador'],
                    'data'=>implode("/",array_reverse(explode("-",$d['ent_data']))),
                    'empresa'=>$d['ent_empresa'],
                    'horario'=>$d['ent_horario'],
                    'obs'=>$d['ent_obs'],
                    'end_cidade'=> $d['ent_end_cidade'],
                    'end_estado'=> $d['ent_end_estado'],
                    'end_bairro'=> $d['ent_end_bairro'],
                    'end_rua'=> $d['ent_end_rua'],
                    'end_numero'=>$d['ent_end_numero'],
                    'end_complemento' => $d['ent_end_complemento'],
                    'end_logradouro' => $d['ent_end_logradouro']
            ];  
                
            break;
        }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'cod' => "disabled",
                    'entrevistador' => "disabled",
                    'entrevistado' => "disabled",
                    'data' => "disabled", 
                    'empresa' => "disabled", 
                    'obs' =>'enabled',
                    'end_cidade' => "enabled",
                    'end_estado' => "enabled",
                    'end_bairro' => "enabled",
                    'end_rua' => "enabled",
                    'end_numero' => "enabled",
                    'end_complemento' => "enabled",
                    'end_logradouro' => "enabled",
                    'horario' => "enabled",
                    'action' => 'visualizar'
                ];
            return view('crud-entrevista/entrevistaForm',compact("title","fieldDateTitle","fieldDate","resp","enabledEdition","states"));    
    }
    
    public function create($ent_cod=null){
        
        $enti ="ent";
        $fieldDate="_data";    
        $states = DB::select('select * from estados');
                
        if($ent_cod!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="SISSAR Edição Entrevista";
            $dadosEnts = $this->ent->where("ent_cod",$ent_cod)->get();   
            foreach($dadosEnts as $d){
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $d['ent_cod'],
                    'entrevistado' => $d['ent_entrevistado'],
                    'entrevistador'=>$d['ent_entrevistador'],
                    'data'=>implode("/",array_reverse(explode("-",$d['ent_data']))),
                    'empresa'=>$d['ent_empresa'],
                    'horario'=>$d['ent_horario'],
                    'obs'=>$d['ent_obs'],
                    'end_complemento' => $d['ent_end_complemento'],
                    'end_cidade'=> $d['ent_end_cidade'],
                    'end_estado'=> $d['ent_end_estado'],
                    'end_bairro'=> $d['ent_end_bairro'],
                    'end_rua'=> $d['ent_end_rua'],
                    'end_numero' => $d['ent_end_numero'],
                    'end_logradouro' => $d['ent_end_logradouro']
                    ];  
                
                break;
            }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'cod' => "disabled",
                    'entrevistador' => "disabled",
                    'entrevistado' => "disabled",
                    'data' => "enabled", 
                    'empresa' => "disabled",
                    'obs' =>'enabled',
                    'end_cidade' => "enabled",
                    'end_estado' => "enabled",
                    'end_bairro' => "enabled",
                    'end_rua' => "enabled",
                    'end_numero' => "enabled",
                    'end_complemento' => "enabled",
                    'end_logradouro' => "enabled",
                    'horario' => "enabled",
                    'action' => 'editar'
                ];
            return view('crud-entrevista/entrevistaForm',compact("title","enti","fieldDate","resp","enabledEdition","states"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="SISSAR Cadastro Entrevista";
            return view('crud-entrevista/entrevistaForm',compact("title","enti","fieldDate","states")); 
        }                
    }
    
    public function store(Request $request){
        $dataForm = $request->except('_token');//recebendo dados dos input do formulario
        $dataForm['ent_data']= implode("/",array_reverse(explode("/",$dataForm['ent_data'])));
        $this->validate($request,$this->ent->rules,$this->messages);//Chamando validação dos dados de entrada
        $insert = $this->ent->create($dataForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
           return redirect('/entrevista/list'); 
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){
        $dataForm = $request->except('_token');//recebe dados do formulario
        $dataForm['ent_data']= implode("/",array_reverse(explode("/",$dataForm['ent_data'])));
        $this->validate($request,$this->ent->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->ent->where('ent_cod',$id)->update($dataForm);//alterado a linha selecionada no banco de dados     
              
        if($update)
           return redirect('/entrevista/list'); 
        else return redirect ()->back();
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->ent->where('ent_cod',$id)->update(["ent_status"=>'0']);
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/entrevista/list'); 
        else return redirect ()->back();
    }    
}
