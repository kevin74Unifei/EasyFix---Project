<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Entrevista;
use DB;
class EntrevistaController extends Controller
{
    private $ent;
    private $userCtr;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
            'ent_data_inicial.required'=>"É obrigatorio preechimento do campo DATA INICIAL",
            'ent_data_final.required'=>"É obrigatorio preechimento do campo DATA FINAL",
            'ent_tipo_prof.required'=>"É obrigatorio preechimento do campo TIPO DE PROFISSIONAL",
        ];
    
    public function __construct(Entrevista $f, UserController $user){
        $this->ent=$f;       
        $this->userCtr = $user;
    }
    
    public function index(Request $request){        
        $title="EasyFix";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter && $filter['campo_tipo_prof']!= 'Todos'){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosEnt = $this->ent->where('ent_tipo_prof',$filter['campo_tipo_prof'])
                                ->orderBy('ent_data_inicial', 'asc')
                                ->get(); 
            
            
            $valor_filter_campo = $filter['campo_tipo_prof'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosEnt = $this->ent->orderBy('ent_data_inicial', 'asc')->get();             
        }   
        
        foreach($dadosEnt as $d){
                $d['ent_data_inicial'] = implode("/",array_reverse(explode("-",$d['ent_data_inicial'])));
                $d['ent_data_final'] = implode("/",array_reverse(explode("-",$d['ent_data_final'])));
            }
        
        return view("crud-entrevista/entrevistaList",compact("dadosEnt",
                                                                "title",'valor_filter_campo'));
    }

    
    public function create($ent_cod=null){
        
        $enti ="ent";
        $fieldDate="_data";    
        
                
        if($ent_cod!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="EasyFix";
            $dadosEnts = $this->ent->where("ent_cod",$ent_cod)->get();   
            foreach($dadosEnts as $d){
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $d['ent_cod'],
                    'data_inicial' => implode("/",array_reverse(explode("-",$d['ent_data_inicial']))),
                    'data_final' => implode("/",array_reverse(explode("-",$d['ent_data_final']))),
                    'tipo_prof' => $d['ent_tipo_prof'],
                    'status'=>$d['ent_status'],
                    'cod_pres'=>$d['ent_cod_pres'],
                    'cod_clie'=>$d['ent_cod_clie']
                    ];  
                
                break;
            }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'cod' => "disabled",
                    'data_inicial' => "enabled",
                    'data_final' => "enabled",
                    'tipo_prof' => "disabled", 
                   
                ];
            return view('crud-entrevista/entrevistaForm',compact("title","enti","fieldDate","resp","enabledEdition"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="EasyFix";
            return view('crud-entrevista/entrevistaForm',compact("title","enti","fieldDate")); 
        }                
    }
    
    public function store(Request $request){
        $dataForm = $request->except('_token');//recebendo dados dos input do formulario
        $dataForm['ent_data_inicial']= implode("/",array_reverse(explode("/",$dataForm['ent_data_inicial'])));
        $dataForm['ent_data_final']= implode("/",array_reverse(explode("/",$dataForm['ent_data_final'])));
        $this->validate($request,$this->ent->rules,$this->messages);//Chamando validação dos dados de entrada
        $insert = $this->ent->create($dataForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
           return redirect('/servico/list'); 
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){
        $dataForm = $request->except('_token');//recebendo dados dos input do formulario
        $dataForm['ent_data_inicial']= implode("/",array_reverse(explode("/",$dataForm['ent_data_inicial'])));
        $dataForm['ent_data_final']= implode("/",array_reverse(explode("/",$dataForm['ent_data_final'])));
        $this->validate($request,$this->ent->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->ent->where('ent_cod',$id)->update($dataForm);//alterado a linha selecionada no banco de dados     
              
        if($update)
           return redirect('/servico/list'); 
        else return redirect ()->back();
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->ent->where('ent_cod',$id)->delete();
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/servico/list'); 
        else return redirect ()->back();
    }    
    
    public function getServico(){
        return $this->ent->get();
    }
}
