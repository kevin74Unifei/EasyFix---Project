<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use DB;
class EmpresaController extends Controller
{
    private $emp;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
            'emp_nome.required' => "É obrigatorio preechimento do campo NOME",
            'emp_nome.min' => "É obrigatorio preechimento do campo NOME com pelo menos 3 letras",
            'emp_razao'=>'É obrigatorio preechimento do campo Razão Social',
            'em_CNPJ'=>'É obrigatorio preechimento do campo CNPJ',
            'emp_inscricaEst'=>'É obrigatorio preechimento do campo Inscrição estadual',
            'emp_email'=>'É obrigatório preenchimento do Email',
            'emp_telefone'=>'É obrigatório preenchimento do Telefone',
            'emp_end_cidade.required'=> "É obrigatorio preechimento do campo Cidade",
            'emp_end_estado.required'=> "É obrigatorio preechimento do campo Estado",
            'emp_end_bairro.required'=> "É obrigatorio preechimento do campo Bairro",
            'emp_end_rua.required'=> "É obrigatorio preechimento do campo Nome do Logradouro",
            'emp_end_numero.required'=>"É obrigatorio preechimento do campo Numero",                     
    ];
    
    public function __construct(Empresa $f){
        $this->emp=$f;        
    }
    
    public function index(Request $request){        
        $title="SISSAR Painel Empresa";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosEmp = $this->emp->where("emp_status",'1')
                                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                                ->orderBy('emp_nome', 'asc')
                                ->get(); 
            
            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosEmp = $this->emp->where("emp_status",'1')->orderBy('emp_nome', 'asc')->get();                                
        }       
        
        return view("crud-empresa/empresaList",compact("dadosEmp",
                                                                "title",
                                                                "valor_filter_text",
                                                                "valor_filter_campo"));
    }
    
    public function show($emp_cod){
        $title="SISSAR Visualização Empresa";            
        
        $states = DB::select('select * from estados');//pesquisando estados do Brasil no banco
        
        $dadosEmps = $this->emp->where("emp_cod",$emp_cod)->get();   
        foreach($dadosEmps as $d){
            $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $d['emp_cod'],
                    'nome' => $d['emp_nome'],
                    'razao' => $d['emp_razao'],
                    'CNPJ' => $d['emp_CNPJ'], 
                    'inscricaEst' => $d['emp_inscricaEst'],  
                    'end_cidade' => $d['emp_end_cidade'],
                    'end_estado' => $d['emp_end_estado'],
                    'end_bairro' => $d['emp_end_bairro'],
                    'end_rua' => $d['emp_end_rua'],
                    'end_numero' => $d['emp_end_numero'],
                    'end_complemento' => $d['emp_end_complemento'],
                    'end_logradouro' => $d['emp_end_logradouro'],
                    'email' => $d['emp_email'],
                    'telefone' => $d['emp_telefone'],
                    'telefoneCel' => $d['emp_telefoneCel']
            ];  
                
            break;
        }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'cod' => "disabled",
                    'nome' => "disabled",
                    'razao' => "disabled",
                    'CNPJ' => "disabled", 
                    'inscricaEst' => "disabled",  
                    'end_cidade' => "disabled",
                    'end_estado' => "disabled",
                    'end_bairro' => "disabled",
                    'end_rua' => "disabled",
                    'end_numero' => "disabled",
                    'end_complemento' => "disabled",
                    'end_logradouro' => "disabled",
                    'email' => "disabled",
                    'telefone' => "disabled",
                    'telefoneCel' => "enabled",
                    'action' => 'visualizar'
                ];
            return view('crud-empresa/empresaForm',compact("title","fieldDateTitle","fieldDate","resp","enabledEdition","states"));    
    }
    
    public function create($emp_cod=null){
        
        $ent ="emp";
        
        $states = DB::select('select * from estados');
                
        if($emp_cod!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="SISSAR Edição Empresa";
            $dadosEmps = $this->emp->where("emp_cod",$emp_cod)->get();   
            foreach($dadosEmps as $d){
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $d['emp_cod'],
                    'nome' => $d['emp_nome'],
                    'razao' => $d['emp_razao'],
                    'CNPJ' => $d['emp_CNPJ'], 
                    'inscricaEst' => $d['emp_inscricaEst'],  
                    'end_cidade' => $d['emp_end_cidade'],
                    'end_estado' => $d['emp_end_estado'],
                    'end_bairro' => $d['emp_end_bairro'],
                    'end_rua' => $d['emp_end_rua'],
                    'end_numero' => $d['emp_end_numero'],
                    'end_complemento' => $d['emp_end_complemento'],
                    'end_logradouro' => $d['emp_end_logradouro'],
                    'email' => $d['emp_email'],
                    'telefone' => $d['emp_telefone'],
                    'telefoneCel' => $d['emp_telefoneCel'],
                    ];  
                
                break;
            }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'cod' => "disabled",
                    'nome' => "disabled",
                    'razao' => "disabled",
                    'CNPJ' => "disabled", 
                    'inscricaEst' => "disabled",  
                    'end_cidade' => "enabled",
                    'end_estado' => "enabled",
                    'end_bairro' => "enabled",
                    'end_rua' => "enabled",
                    'end_numero' => "enabled",
                    'end_complemento' => "enabled",
                    'end_logradouro' => "enabled",
                    'email' => "enabled",
                    'telefone' => "enabled",
                    'telefoneCel' => "enabled",
                    'action' => 'editar'
                ];
            return view('crud-empresa/empresaForm',compact("title","ent","fieldDateTitle","fieldDate","resp","enabledEdition","states"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="SISSAR Cadastro Empresa";
            return view('crud-empresa/empresaForm',compact("title","ent","fieldDateTitle","fieldDate","states")); 
        }                
    }
    
    public function store(Request $request){
        $dataForm = $request->except('_token');//recebendo dados dos input do formulario
      
        $this->validate($request,$this->emp->rules,$this->messages);//Chamando validação dos dados de entrada
        $insert = $this->emp->create($dataForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
           return redirect('/empresa/list'); 
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){
        $dataForm = $request->except('_token');//recebe dados do formulario
        
        $this->validate($request,$this->emp->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->emp->where('emp_cod',$id)->update($dataForm);//alterado a linha selecionada no banco de dados     
              
        if($update)
           return redirect('/empresa/list'); 
        else return redirect ()->back();
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->emp->where('emp_cod',$id)->update(["emp_status"=>'0']);
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/empresa/list'); 
        else return redirect ()->back();
    }    
}
