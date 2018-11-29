<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Usuario;
use App\User;
use App\Curriculo;
use DB;

class CandidatoController extends Controller
{
    private $cand;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
            'cand_nome.required' => "É obrigatorio preechimento do campo NOME",
            'cand_nome.min' => "É obrigatorio preechimento do campo NOME com pelo menos 3 letras",
            'cand_CPF.required' => "É obrigatorio preechimento do campo CPF",
            'cand_dataNasc.required'=> "É obrigatorio preechimento do campo Data de nascimento",
            'cand_end_cidade.required'=> "É obrigatorio preechimento do campo Cidade",
            'cand_end_estado.required'=> "É obrigatorio preechimento do campo Estado",
            'cand_end_bairro.required'=> "É obrigatorio preechimento do campo Bairro",
            'cand_end_rua.required'=> "É obrigatorio preechimento do campo Nome do Logradouro",
            'cand_end_numero.required'=>"É obrigatorio preechimento do campo Numero",
            'cand_email.required'=>"É obrigatorio preechimento do campo E-mail"
    ];
    
    public function __construct(Usuario $f){
        $this->cand=$f;        
    }
    
    public function index(Request $request){
        $title="EasyFix";        
       
        $filter = $request->all();//Carregando filtros        
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosCand = $this->cand->where("usr_status",'1')
                                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                                ->orderBy('usr_nome', 'asc')
                                ->get(); 
            
            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosCand = $this->cand->where("usr_status",'1')->orderBy('usr_nome', 'asc')->get();
        } 
        
        $dadosCandUser = array();//criando um array
        foreach($dadosCand as $d){
            $user = User::where('user_perfil','Candidato')
                    ->where("user_vinculo",$d['cand_cod'])->get()->first();
            
             array_push($dadosCandUser, array(//colocando no final do vetor mais um vetor, assim criando uma matriz
               "usr_cod" => $d['cand_cod'],
               "usr_nome" => $d['cand_nome'],
               "usr_CPF" => $d['cand_CPF'],
               "usr_imagem" => $d['cand_imagem'],
               "usr_codUser" => $user['id'],
               "usr_username" => $user['username'],
            ));
        }
        
        return view("crud-candidato/candidatosList",compact("dadosCandUser",
                                                                "title",
                                                                "valor_filter_text",
                                                                "valor_filter_campo"));
    }
    
    public function create($cand_cod = null){
        $ent = "cand";
        $title = "EasyFix";
        $fieldDateTitle="Data de Nascimento";
        $fieldDate="_dataNasc";
        
        $states = DB::select('select * from estados');//pesquisando estados do Brasil no banco    
        
        if($cand_cod!=null){//Se recebe um parametro, faz o que esta aqui dentro
            $title="EasyFix";
            $dadosCand = $this->cand->where("usr_cod",$cand_cod)->get()->first();
           
                $resp= [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'cod' => $dadosCand['cand_cod'],
                    'nome' => $dadosCand['cand_nome'],
                    'imagem' => $dadosCand['cand_imagem'],
                    'CPF' => $dadosCand['cand_CPF'], 
                    'data' => implode("/",array_reverse(explode("-",$dadosCand['cand_dataNasc']))),
                    'end_cidade' => $dadosCand['cand_end_cidade'],
                    'end_estado' => $dadosCand['cand_end_estado'],
                    'end_bairro' => $dadosCand['cand_end_bairro'],
                    'end_rua' => $dadosCand['cand_end_rua'],
                    'end_numero' => $dadosCand['cand_end_numero'],
                    'end_complemento' => $dadosCand['cand_end_complemento'],
                    'end_logradouro' => $dadosCand['cand_end_logradouro'],
                    'email' => $dadosCand['cand_email'],
                    'telefone' => $dadosCand['cand_telefone'],
                    'telefoneCel' => $dadosCand['cand_telefoneCel'],
                    'sexo' => $dadosCand['cand_sexo'],                    
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
            return view('crud-candidato/candidatoForm',compact("title","ent","fieldDateTitle","fieldDate","resp","enabledEdition","states"));
        }else{//Se não tiver parametros retorna um formulario basico de cadastro
            $title="EasyFix";
            return view('crud-candidato/candidatoForm',compact("title","ent","fieldDateTitle","fieldDate","states")); 
        }
 
    }
    
    public function show($id){
        
        $dadosCand = $this->cand->where("usr_cod",$id)->get()->first();
        
        $title = "EasyFix ".$dadosCand['cand_nome'];
        return view('crud-candidato/candidatoView',compact("title","dadosCand"));  
    }
    
    public function store(Request $request){
        $dadosCandadosForm = $request->except('_token');//recebendo dados dos input do formulario
        
        if($request->hasFile('usr_imagem')){//Se existir imagem faz upload e armazena
            $imagem = $request->file('usr_imagem');
            $ext=$imagem->getClientOriginalExtension();            
            $filename = md5(time()).".".$ext;//Criando um nome que não será repetido
            $request->cand_imagem->storeAs('/imgperfil', $filename); 
            $dadosCandadosForm['cand_imagem'] = $filename;
        }
        
        //mudando padrão de datas..
        $dadosCandadosForm['cand_dataNasc']= implode("/",array_reverse(explode("/",$dadosCandadosForm['cand_dataNasc'])));
        $this->validate($request,$this->cand->rules,$this->messages);//Chamando validação dos dados de entrada
        $insert = $this->cand->create($dadosCandadosForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
        {
           return redirect('/usuario/cadastro/cand/'.$insert['id']); 
        }
        else return redirect ()->back();
    }
    
    public function edit($id,Request $request){
        $dataForm = $request->except('_token');//recebe dados do formulario
        
        if($request->hasFile('cand_imagem')){//Se existir imagem faz upload e armazena   
            $imagem = $request->file('cand_imagem');
            $ext=$imagem->getClientOriginalExtension();            
            $filename = md5(time()).".".$ext;//Criando um nome que não se repetirar
            $request->cand_imagem->storeAs('public/imgperfil', $filename); 
            $dataForm['cand_imagem'] = $filename;
        }
        
        $this->validate($request,$this->cand->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->cand->where('usr_cod',$id)->update($dataForm);//alterado a linha selecionada no banco de dados
              
        if($update)
           return redirect('/'); 
        else return redirect ()->back();
    }
    
    public function loadPainel(){
        $currs = Curriculo::where('usr_cod',Auth::user()->user_vinculo)
                ->where('curr_active','1')
                ->get();
        
        return view('painel/candView', compact('currs'));
    }
    
    public function destroy($id){
        //fazendo a alteração do status da linha do banco de dados 
        $update = $this->cand->where('usr_cod',$id)->update(["usr_status"=>'0']);
        
         if($update)//se feito com sucesso direciona para...
           return redirect('/candidato/list'); 
        else return redirect ()->back();
    }   
}
