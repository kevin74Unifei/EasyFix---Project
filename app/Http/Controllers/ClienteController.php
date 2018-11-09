<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cliente;
use App\User;
use App\Curriculo;
use DB;

class ClienteController extends Controller
{
    private $cliente;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
            'cliente_nome.required' => "É obrigatorio preechimento do campo NOME",
            'cliente_nome.min' => "É obrigatorio preechimento do campo NOME com pelo menos 3 letras",
            'cliente_CPF.required' => "É obrigatorio preechimento do campo CPF",
            'cliente_dataNasc.required'=> "É obrigatorio preechimento do campo Data de nascimento",
            'cliente_end_cidade.required'=> "É obrigatorio preechimento do campo Cidade",
            'cliente_end_estado.required'=> "É obrigatorio preechimento do campo Estado",
            'cliente_end_bairro.required'=> "É obrigatorio preechimento do campo Bairro",
            'cliente_end_rua.required'=> "É obrigatorio preechimento do campo Nome do Logradouro",
            'cliente_end_numero.required'=>"É obrigatorio preechimento do campo Numero",
            'cliente_email.required'=>"É obrigatorio preechimento do campo E-mail"
    ];
    
    public function __construct(Cliente $c){
        $this->cliente=$c;        
    }
    
    public function index(Request $request){
        $title="EasyFix";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosCliente = $this->cliente->where("cliente_status",'1')
                                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                                ->orderBy('cliente_nome', 'asc')
                                ->get(); 
            
            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosCliente = $this->cliente->where("cliente_status",'1')->orderBy('cliente_nome', 'asc')->get();                                
        } 
        
        $dadosClienteUser = array();//criando um array
        foreach($dadosCliente as $d){
            $user = User::where('user_perfil','Cliente')
                    ->where("user_vinculo",$d['cliente_cod'])->get()->first();
            
             array_push($dadosClienteUser, array(//colocando no final do vetor mais um vetor, assim criando uma matriz
               "cliente_cod" => $d['cliente_cod'],
               "cliente_nome" => $d['cliente_nome'],
               "cliente_CPF" => $d['cliente_CPF'],
               "cliente_imagem" => $d['cliente_imagem'],
               "cliente_codUser" => $user['id'],
               "cliente_username" => $user['username'],                
            ));
        }
        
        return view("crud-cliente/clienteList",compact("dadosClienteUser",
                                                                "title",
                                                                "valor_filter_text",
                                                                "valor_filter_campo"));
    }
    
    public function create($cliente_cod = null){
        $ent = "cliente";
        $title = "EasyFix";
        $fieldDateTitle="Data de Nascimento";
        $fieldDate="_dataNasc";
        
        $states = DB::select('select * from estados');//pesquisando estados do Brasil no banco    
        
        if($cliente_cod!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="EasyFix";
            $dadosCliente = $this->cliente->where("cliente_cod",$cliente_cod)->get()->first();   
           
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $dadosCliente['cliente_cod'],
                    'nome' => $dadosCliente['cliente_nome'],
                    'imagem' => $dadosCliente['cliente_imagem'],
                    'CPF' => $dadosCliente['cliente_CPF'],
                    'data' => implode("/",array_reverse(explode("-",$dadosCliente['cliente_dataNasc']))),
                    'end_cidade' => $dadosCliente['cliente_end_cidade'],
                    'end_estado' => $dadosCliente['cliente_end_estado'],
                    'end_bairro' => $dadosCliente['cliente_end_bairro'],
                    'end_rua' => $dadosCliente['cliente_end_rua'],
                    'end_numero' => $dadosCliente['cliente_end_numero'],
                    'end_complemento' => $dadosCliente['cliente_end_complemento'],
                    'end_logradouro' => $dadosCliente['cliente_end_logradouro'],
                    'email' => $dadosCliente['cliente_email'],
                    'telefone' => $dadosCliente['cliente_telefone'],
                    'telefoneCel' => $dadosCliente['cliente_telefoneCel'],
                    'sexo' => $dadosCliente['cliente_sexo'],                    
                ];  
            
            //Retorna um formulario para alteração de dados.            
                $enabledEdition = [
                    'cod' => "disabled",
                    'nome' => "disabled",
                    'imagem' => "enabled",
                    'CPF' => "disabled", 
                    'data' => "disabled",
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
                    'sexo' => "disabled",
                    'action' => 'editar'
                ];
            return view('crud-cliente/clienteForm',compact("title","ent","fieldDateTitle","fieldDate","resp","enabledEdition","states"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="EasyFix";
            return view('crud-cliente/clienteForm',compact("title","ent","fieldDateTitle","fieldDate","states")); 
        }
 
    }
    
    public function show($id){
        
        $dadosCliente = $this->cliente->where("cliente_cod",$id)->get()->first();  
        
        $title = "EasyFix".$dadosCliente['cliente_nome'];
        return view('crud-cliente/clienteView',compact("title","dadosCliente"));  
    }
    
    public function store(Request $request){
        $dadosClienteForm = $request->except('_token');//recebendo dados dos input do formulario
        
        if($request->hasFile('cliente_imagem')){//Se existir imagem faz upload e armazena   
            $imagem = $request->file('cliente_imagem');
            $ext=$imagem->getClientOriginalExtension();            
            $filename = md5(time()).".".$ext;//Criando um nome que não será repetido
            $request->cliente_imagem->storeAs('public/storage/imgperfil', $filename); 
            $dadosClienteForm['cliente_imagem'] = $filename;
        }
        
        //mudando padrão de datas..
        $dadosClienteForm['clinte_dataNasc']= implode("/",array_reverse(explode("/",$dadosClienteForm['cliente_dataNasc'])));
        $this->validate($request,$this->cliente->rules,$this->messages);//Chamando validação dos dados de entrada
        $insert = $this->cliente->create($dadosClienteForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
        {
           return redirect('/usuario/cadastro/cliente/'.$insert['id']); 
        }
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){
        $dataForm = $request->except('_token');//recebe dados do formulario
        
        if($request->hasFile('cliente_imagem')){//Se existir imagem faz upload e armazena   
            $imagem = $request->file('cliente_imagem');
            $ext=$imagem->getClientOriginalExtension();            
            $filename = md5(time()).".".$ext;//Criando um nome que não se repetirar
            $request->cliente_imagem->storeAs('public/imgperfil', $filename); 
            $dataForm['cliente_imagem'] = $filename;
        }
        
        $this->validate($request,$this->cliente->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->cliente->where('cliente_cod',$id)->update($dataForm);//alterado a linha selecionada no banco de dados     
              
        if($update)
           return redirect('/cliente/list'); 
        else return redirect ()->back();
    }
    
    public function loadPainel(){
        $currs = Curriculo::where('cliente_cod',Auth::user()->user_vinculo)
                ->where('curr_active','1')
                ->get();
        
        return view('painel/clienteView', compact('currs'));
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->cliente->where('cliente_cod',$id)->update(["cliente_status"=>'0']);
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/cliente/list'); 
        else return redirect ()->back();
    }  
}
