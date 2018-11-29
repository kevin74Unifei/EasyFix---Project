<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EntrevistaController;
use App\Pagamento;
use App\Empresa;
use DB;


class PagamentoController extends Controller
{
    private $pag;
    private $entCtr;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
        
    ];
    
    public function __construct(Pagamento $f, EntrevistaController $ent){
        $this->pag=$f;        
        $this->entCtr = $ent;
    }
    
    public function index(Request $request){        
        $title="EasyFix";        
        $ent = $this->entCtr->getServico();
        return view("crud-pagamento/PagamentoList",compact("ent",
                                                                "title"));
    }
    
    public function show($pag_cod){
        $title="EasyFix";            
        
        $states = DB::select('select * from estados');//pesquisando estados do Brasil no banco
        
        $dadosPags = $this->pag->where("pag_cod",$pag_cod)->get();   
        foreach($dadosPags as $d){
            $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'Emppag' => $d['pag_empresa'],
                    'pag_Serviços_Prestados' => $d['pag_Serviços_Prestados'],
                    'pag_DataAtual' => $d['dataAtual'],
                    'pag_Valor_Unitario' => $d['pag_Valor_Unitario'], 
                    'pag_Descriçao' => $d['pag_Descriçao'],  
                    'pag_Tipopag' => $d['pag_Tipopag'],
            ];  
                
            break;
        }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'Emppag' => "disabled",
                    'pag_Serviços_Prestados' => "disabled",
                    'pag_DataAtual' => "disabled",
                    'pag_Valor_Unitario' => "disabled", 
                    'pag_Descriçao' => "disabled",  
                    'pag_Tipopag' => "enabled",
                    'action' => 'editar'
                ];
            return view('crud-pagamento/PagamentoForm',compact("title","fieldDateTitle","fieldDate","resp","enabledEdition","states"));    
    }
    
    public function create($pag_id=null){        
        $ent ="pag";
                
        if($pag_id!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="EasyFix";
            $dadosPags = $this->pag->where("pag_id",$pag_id)->get();   
            foreach($dadosPags as $d){
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'pag_id' => $d['pag_id'],
                    'pag_empresa_cod' => $d['pag_empresa_cod'],
                    'pag_tipoPag' => $d['pag_tipoPag'],
                    'pag_valorPag' => $d['pag_valorPag'], 
                    'pag_desconto' => $d['pag_desconto'],  
                    'pag_valorTotal' => $d['pag_valorTotal'],
                    'pag_situacao' => $d['pag_situacao'],
                    ];  
                
                break;
            }//Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                   'Empresa' => 'disabled', 
                ];
                $dadosEmpresas= Empresa::where('emp_cod',$resp['pag_empresa_cod'])->get();
                
            return view('crud-pagamento/PagamentoForm',compact("title","ent","resp","enabledEdition","dadosEmpresas"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="EasyFix";
            $ent="pag";
            
            $dadosEmpresas = Empresa::where("emp_status","1")->get();
            
            return view('crud-pagamento/PagamentoForm',compact("title","ent","dadosEmpresas")); 
        }                
    }
    
    public function store(Request $request){//ok
        $dataForm = $request->except('_token');//recebendo dados dos input do formulario
      
        $this->validate($request,$this->pag->rules);//Chamando validação dos dados de entrada
        
        $dadosPagCad= [
            'pag_empresa_cod'=>$dataForm['pag_empresa_cod'],
            'pag_tipoPag'=>$dataForm['pag_tipoPag'],
            'pag_valorPag'=>$dataForm['pag_valorPag'],
            'pag_desconto'=>$dataForm['pag_desconto'],
            'pag_situacao'=>"Aguardando",
            'pag_valorTotal'=>$dataForm['pag_valorPag']-($dataForm['pag_valorPag']*($dataForm['pag_desconto']/100)),            
        ];
        
        $insert = $this->pag->create($dadosPagCad);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
           return redirect('/pagamento/list'); 
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){//ok
        $dataForm = $request->except('_token');//recebe dados do formulario
        
        $this->validate($request,$this->pag->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        
         $dadosPagCad= [            
            'pag_tipoPag'=>$dataForm['pag_tipoPag'],
            'pag_valorPag'=>$dataForm['pag_valorPag'],
            'pag_desconto'=>$dataForm['pag_desconto'],           
            'pag_valorTotal'=>$dataForm['pag_valorPag']-($dataForm['pag_valorPag']*($dataForm['pag_desconto']/100)),
             'pag_situacao' => $dataForm['pag_situacao'],
        ];
        
        $update = $this->pag->where('pag_id',$id)->update($dadosPagCad);//alterado a linha selecionada no banco de dados     
              
        if($update)
           return redirect('/pagamento/list'); 
        else return redirect ()->back();
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->pag->where('pag_id',$id)->update(["pag_active"=>'0']);
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/pagamento/list'); 
        else return redirect ()->back();
    }
    
    
}
