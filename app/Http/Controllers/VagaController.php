<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vaga;
use App\Empresa;

class VagaController extends Controller
{
    private $vag;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
            'vag_nome' => "É obrigatorio preechimento do campo NOME",
            'vag_nome.min' => "É obrigatorio preechimento do campo NOME com pelo menos 3 letras",
            'vag_tipoPag'=>"É obrigatorio preechimento do campo Tipo de Vaga",
            'vag_valorPag'=>"É obrigatorio preechimento do campo Valor de Pagamento",
            'vag_escolar'=>"É obrigatorio preechimento do campo Nível de escolaridade desejado",
            'vag_idioma'=>"É obrigatorio preechimento do campo Idioma",
            'vag_estado'=>"É obrigatorio preechimento do campo Estado",
            'vag_regime'=> "É obrigatorio preechimento do campo Regime",
            'vag_dias'=> "É obrigatorio preechimento do campo Dias",
            'vag_horario'=> "É obrigatorio preechimento do campo Horário",
            'vag_beneficios'=> "É obrigatorio preenchimento do campo Benefícios",
            'vag_email'=>'É obrigatório preenchimento do Email',
            'vag_nomeEmpresa'=>'É obrigatório preenchimento do Email',
            'vag_telefone'=>'É obrigatório preenchimento do Telefone',
    ];
    
    public function __construct(Vaga $f){
        $this->vag=$f;        
    }
    
    public function index(Request $request){        
        $title="SISSAR Painel Vaga";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosVag = $this->vag->where("vag_active",'1')
                                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                                ->orderBy('vag_nome', 'asc')
                                ->get(); 
            
            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosVag = $this->vag->where("vag_active",'1')->orderBy('vag_nome', 'asc')->get();                                
        }       
        
        return view("crud-vaga/vagaList",compact("dadosVag",
                                                                "title",
                                                                "valor_filter_text",
                                                                "valor_filter_campo"));
    }
    
    public function show($vag_id=null){
        $ent ="vag";
        $title="SISSAR Edição Vaga";
            $d = $this->vag->where("vag_id",$vag_id)->get()->first();   
            
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'id' => $d['vag_id'],
                    'nome' => $d['vag_nome'],
                    'tipoPag'=>$d['vag_tipoPag'],
                    'valorPag'=>$d['vag_valorPag'],
                    'escolar'=>$d['vag_escolar'],
                    'idioma'=>$d['vag_idioma'],
                    'estado'=>$d['vag_estado'],
                    'regime'=> $d['vag_regime'],
                    'dias'=> $d['vag_dias'],
                    'horario'=> $d['vag_horario'],
                    'beneficios'=> $d['vag_beneficios'],
                    'nomeEmpresa'=>$d['vag_nomeEmpresa'],
                    'email' => $d['vag_email'],
                    'telefone' => $d['vag_telefone'],
                    'telefoneCel' => $d['vag_telefoneCel'],
                    'nomeEmp' => $d['vag_nomeEmpresa'],
                    'vagCod'=>$d['vag_empresa_cod']
                ];
         
            //Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'id' => "disabled",
                    'nome' => "enabled",
                    'tipoPag' => "enabled",
                    'valorPag' => "enabled", 
                    'escolar' => "enabled",  
                    'idioma' => "enabled",
                    'estado' => "enabled",
                    'regime' => "enabled",
                    'dias' => "enabled",
                    'horario' => "enabled",
                    'beneficios' => "enabled",
                    'nomeEmpresa'=>"disabled",
                    'email' => "enabled",
                    'telefone' => "enabled",
                    'telefoneCel' => "enabled",
                    'nomeEmp' =>"disabled",
                    'vagCod'=>"disabled",
                    'action' => 'editar'
                ];
            return view('crud-vaga/vagaForm',compact("title","ent","resp","enabledEdition"));   
    }
    
    public function create($vag_id=null){
        $ent ="vag";
        $id = $vag_id;
        $vag_id =null;
        if($vag_id!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="SISSAR Edição Vaga";
            $dadosVags = $this->vag->where("vag_id",$vag_id)->get();   
            foreach($dadosVags as $d){
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'id' => $d['vag_id'],
                    'nome' => $d['vag_nome'],
                    'tipoPag'=>$d['vag_tipoPag'],
                    'valorPag'=>$d['vag_valorPag'],
                    'escolar'=>$d['vag_escolar'],
                    'idioma'=>$d['vag_idioma'],
                    'estado'=>$d['vag_estado'],
                    'regime'=> $d['vag_regime'],
                    'dias'=> $d['vag_dias'],
                    'horario'=> $d['vag_horario'],
                    'beneficios'=> $d['vag_beneficios'],
                    'nomeEmpresa'=>$d['vag_nomeEmpresa'],
                    'email' => $d['vag_email'],
                    'telefone' => $d['vag_telefone'],
                    'telefoneCel' => $d['vag_telefoneCel'],
                    'nomeEmp' => $d['vag_nomeEmpresa']
                ];
                
                break;
            }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'id' => "disabled",
                    'nome' => "enabled",
                    'tipoPag' => "enabled",
                    'valorPag' => "enabled", 
                    'escolar' => "enabled",  
                    'idioma' => "enabled",
                    'estado' => "enabled",
                    'regime' => "enabled",
                    'dias' => "enabled",
                    'horario' => "enabled",
                    'beneficios' => "enabled",
                    'nomeEmpresa'=>"disabled",
                    'email' => "enabled",
                    'telefone' => "enabled",
                    'telefoneCel' => "enabled",
                    'action' => 'editar'
                ];
            return view('crud-vaga/vagaForm',compact("title","ent","resp","enabledEdition"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="SISSAR Cadastro Vaga";
               
               $emp = new Empresa(); //Recuperando dados do funcionario recém cadastrado          
               $dadosEmp = $emp->where("emp_cod",$id)->get()->first(); 
               $u = $this->vag->where('vag_empresa_cod',$dadosEmp['emp_cod'])->get();
               
               $dadosEnt = [//Carregando em um vetor generico
                    'nomeEmpresa'=> $dadosEmp['emp_nome'] ,                   
                    'email'=> $dadosEmp['emp_email'],
                    'vag_empresa_cod'=>$dadosEmp['emp_cod'],
                ];

            return view('crud-vaga/vagaForm',compact("title","ent","dadosEnt", "enabledEdition")); 
        }                
    }
    
    public function store(Request $request){
        $dataForm = $request->except('_token');//recebendo dados dos input do formulario
      
        $this->validate($request,$this->vag->rules,$this->messages);//Chamando validação dos dados de entrada
        $insert = $this->vag->create($dataForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
           return redirect('/vaga/list'); 
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){
        $dataForm = $request->except('_token');//recebe dados do formulario
        
        $this->validate($request,$this->vag->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->vag->where('vag_id',$id)->update($dataForm);//alterado a linha selecionada no banco de dados     
              
        if($update)
           return redirect('/vaga/list'); 
        else return redirect ()->back();
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->vag->where('vag_id',$id)->update(["vag_active"=>'0']);
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/vaga/list'); 
        else return redirect ()->back();
    }
    
}
