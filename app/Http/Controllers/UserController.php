<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\MessageBag;
use App\User;
use App\Funcionario;
use App\Candidato;
use App\Cliente;

class UserController extends Controller {
    
    private $user;
    private $messages = [
            'username.required' => "É obrigatório o preechimento do campo Nome de Usuário",
            'user_login.min' => "É obrigatório o preechimento do campo Nome de Usuário com pelo menos 3 letras",
            'password.required' => "É obrigatório op preenchimento do campo Senha",
            'password.min' => "É obrigatório o preechimento do campo Senha com pelo menos 7 letras",
            'user_perfil.required' =>"É obrigatório a escolha de um perfil",
        ];
    
    public function __construct(User $u) {
        $this->user = $u;
    }
    
   public function create($ent,$id) {        
        $title="EasyFix";       
        
        if($id!=null){
            if($ent=='func'){    //Se funcionario       
               $u = $this->user->whereIn('user_perfil',['Administrador','Atedente'])->where('user_vinculo',$id)->get();
               
               if(isset($u['id'])){
                   return redirect('/');
                   //Se ja existir usuario para esse funcionario, impede de acessa a pagina cadastro
               }
                
               $func = new Funcionario(); //Recuperando dados do funcionario recém cadastrado          
               $dadosFunc = $func->where("func_cod",$id)->get()->first(); 
               
               $dadosEnt = [//Carregando em um vetor generico
                    'cod' => $dadosFunc['func_cod'],
                    'imagem' => $dadosFunc['func_imagem'],
                    'nome'=> $dadosFunc['func_nome'] ,                   
                    'cpf'=> $dadosFunc['func_CPF'],                   
                ];
     
               
            }else if($ent=='cand'){//Se candidato
                $u = $this->user->where('user_perfil','Candidato')->where('user_vinculo',$id)->get();
                if(isset($u['id'])){                   
                    return redirect('/');                   
                   //Se ja existir usuario para esse candidato, impede de acessa a pagina cadastro
                }
                
                $cand = new Candidato();//Recuperando dados do candidato recém cadastrado        
                $dadosCand = $cand->where("cand_cod",$id)->get()->first(); 
                
                $dadosEnt = [//Carregando em um vetor generico os dados
                    'cod' => $dadosCand['cand_cod'],
                    'imagem' => $dadosCand['cand_imagem'],
                    'nome'=> $dadosCand['cand_nome'] ,                   
                    'cpf'=> $dadosCand['cand_CPF'],                    
                ];
                
            }else if($ent=='cliente'){//Se cliente
                $u = $this->user->where('user_perfil','Cliente')->where('user_vinculo',$id)->get();
                if(isset($u['id'])){                   
                    return redirect('/');                   
                   //Se ja existir usuario para esse candidato, impede de acessa a pagina cadastro
                }
                
                $cliente = new Cliente();//Recuperando dados do candidato recém cadastrado        
                $dadosCliente = $cliente->where("cliente_cod",$id)->get()->first(); 
                
                $dadosEnt = [//Carregando em um vetor generico os dados
                    'cod' => $dadosCliente['cliente_cod'],
                    'imagem' => $dadosCliente['cliente_imagem'],
                    'nome'=> $dadosCliente['cliente_nome'] ,                   
                    'cpf'=> $dadosCliente['cliente_CPF'],                    
                ];
            }            
            return view('crud-usuario/CadastroUsuario', compact("title", "ent","dadosEnt"));
        }
    }

    
    public function editor($user_id) {
        $ent ="user";
        $title="EasyFix";       
        
        $dadosUsers = $this->user->where("id",$user_id)->get()->first();
           
        if($dadosUsers['user_perfil']=='Administrador'|| $dadosUsers['user_perfil']=='Atendente'){
            $func = new Funcionario();            
            $dadosFunc = $func->where("func_cod",$dadosUsers["user_vinculo"])->get()->first();        
        
            $dadosEnt = [//Carregando em um vetor generico
                        'cod' => $dadosFunc['func_cod'],
                        'imagem' => $dadosFunc['func_imagem'],
                        'nome'=> $dadosFunc['func_nome'] ,                   
                        'cpf'=> $dadosFunc['func_CPF'],                   
                    ];
        }else if($dadosUsers['user_perfil']=='Candidato'){
                $cand = new Candidato();//Recuperando dados do candidato recém cadastrado        
                $dadosCand = $cand->where("cand_cod",$user_id)->get()->first(); 
                
                $dadosEnt = [//Carregando em um vetor generico os dados
                    'cod' => $dadosCand['cand_cod'],
                    'imagem' => $dadosCand['cand_imagem'],
                    'nome'=> $dadosCand['cand_nome'] ,                   
                    'cpf'=> $dadosCand['cand_CPF'],                    
                ];
        }           
        $resp = $dadosUsers;
            
        $enabledEdition = [
                    'userLogin'=> 'disabled',
                    'userPass'=> 'enabled',
                    'userPerfil'=>'disabled',
                ];
        return view('crud-usuario/CadastroUsuario', compact("title", "ent",'resp',"enabledEdition","dadosEnt"));
        
    }

    public function index(Request $request) {
        $title="EasyFix";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosUser = $this->user->where("user_status",'1')
                                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                                ->orderBy('username', 'asc')
                                ->get(); 
            
            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosUser = $this->user->where("user_status",'1')->orderBy('username', 'asc')->get();
                                
        }       
        
        return view("crud-usuario/listaUsuario",compact("dadosUser",
                                                                "title",
                                                                "valor_filter_text",
                                                                "valor_filter_campo"));
    }

    public function store(Request $request) {
        $dataForm = $request->except('_token');

        if($request->hasFile('usr_imagem')){//Se existir imagem faz upload e armazena
            $imagem = $request->file('usr_imagem');
            $ext=$imagem->getClientOriginalExtension();
            $filename = md5(time()).".".$ext;//Criando um nome que não será repetido
            $request->cand_imagem->storeAs('public/storage/imgperfil', $filename);
            $dataForm['cand_imagem'] = $filename;
        }


        $dataForm['password']= Hash::make($dataForm['password']);
        
        $this->validate($request,$this->user->rules,$this->messages);
        $insert = $this->user->create($dataForm);
        
        if($insert)
           return redirect('/home');
        else return redirect ()->back();
               
    }
 
    public function edit($id, Request $request) {
        $dataUser = $request->except('_token','ConfirmaSenha');//recebe dados do formulario
        
        $dataUser['password']= Hash::make($dataUser['password']);
        
        $this->validate($request,$this->user->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->user->where('id',$id)->update($dataUser);//alterado a linha selecionada no banco de dados 
        
        if($update)
           return redirect('/'); 
        else return redirect ()->back();
    }

    public function destroy($ent,$id) {
         //fazendo a alteração do status da linha do banco de dados 
        $update = $this->user->where('id',$id)->update(["user_status"=>'0']);
        
        if($update)//se feito com sucesso direciona para...
        {
           if($ent=='func')
                return redirect('/funcionario/list'); 
           else if($ent=='cand') return redirect('/candidato/list'); 
        }
        else return redirect ()->back();
    }
    
    public function login(Request $request){
        $dadosForm = $request->except('_token');   
        
        $errors = new MessageBag;
        
        if(Auth::attempt($dadosForm, true)){
            return redirect('/home');
        }else{   
            $errors = new MessageBag(['login' => 'Username e/ou senha não corresponde!']);
            return redirect()->back()->withErrors($errors);            
        }
    }
    
    public function logout(){
        if(Auth::check()){
            Auth::logout(Auth::user());            
        }
        
         return redirect('/');
    }
    
    public function testPass(Request $request){
       $user = $this->user->where('id',Auth::user()->id)->get()->first();        
       $dados = $request->except('_token');
       
       if(Hash::check($dados['userPass'],$user['password'])){
           $resp=1;
       }else{
           $resp=0;
       }        
        return Response::json($resp);
    }
    
}
