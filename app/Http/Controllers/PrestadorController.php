<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Prestador;
use App\User;
use App\Curriculo;
use DB;

class PrestadorController extends Controller
{
    private $prestador;
    private $messages = [//mensagens que serão exibidas quando a validação falhar
    ];

    public function __construct(Prestador $p)
    {
        $this->prestador = $p;
    }

    public function index(Request $request)
    {
        $title="EasyFix";

        $filter = $request->all();//Carregando filtros
        if($filter){//Se filtros existirem, carrega dados atraves da operação LIKE do sql, em ordem crescente
            $dadosPrestador = $this->prestador->where("prestador_status",'1')
                ->where($filter['campo_ent'],'LIKE',$filter['chave_busca'].'%')
                ->orderBy('prestador_nome', 'asc')
                ->get();

            $valor_filter_text = $filter['chave_busca'];
            $valor_filter_campo = $filter['campo_ent'];
        }else{//Senão existir filtros carrega todas as linhas da tabela, por ordem crescente.
            $dadosPrestador = $this->prestador->where("prestador_status",'1')->orderBy('prestador_nome', 'asc')->get();
        }

        $dadosPrestadorArray = array();//criando um array
        foreach($dadosPrestador as $d){

            array_push($dadosPrestadorArray, array(//colocando no final do vetor mais um vetor, assim criando uma matriz
                'prestador_nome' => $d['prestador_nome'],
                'prestador_id' => $d['prestador_cod'],
                'cliente_id' => $d['cliente_id'],
                'prestador_vinculo' => $d['prestador_vinculo'],
                'prestador_representacao' => $d['prestador_representacao'],
                'prestador_descricao' => $d['prestador_descricao'],
            ));
        }

        return view("crud-prestador/prestadorList",compact("dadosPrestadorArray",
            "title",
            "valor_filter_text",
            "valor_filter_campo"));
    }

    public function create($prestador_id = null)
    {
        $ent = "prestador";
        $dadosPrestador = $this->prestador->where("prestador_cod", $prestador_id)->get();

        if (count($dadosPrestador) > 0) {//Se recebe um parametro, faz o que esta aqui dentro
            $title = "EasyFix";
            foreach ($dadosPrestador as $d) {
                $resp = [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'prestador_nome' => $d['prestador_nome'],
                    'prestador_id' => $d['prestador_cod'],
                    'cliente_id' => $d['cliente_id'],
                    'prestador_vinculo' => $d['prestador_vinculo'],
                    'prestador_representacao' => $d['prestador_representacao'],
                    'prestador_mei' => $d['prestador_mei'],
                    'prestador_cnpj' => $d['prestador_cnpj'],
                    'prestador_descricao' => $d['prestador_descricao'],
                ];

                break;
            }//Retorna um formulario para alteração de dados.

            return view('crud-prestador/PrestadorForm', compact("title", "ent", "resp"));
        } else {//Se não tiver parametros retorna um formulario basico de cadastro
            $title = "EasyFix";
            $ent = "prestador";
            $resp = '';

            return view('crud-prestador/PrestadorForm', compact("title", "ent", "dadosEmpresas","prestador_nome","resp"));
        }
    }

    public function show($id)
    {
        $dadosprestador = $this->prestador->where("prestador_cod", $id)->get()->first();

        $title = "EasyFix" . $dadosprestador['prestador_nome'];
        return view('crud-prestador/prestadorView', compact("title", "dadosprestador"));
    }

    public function store(Request $request)
    {
        $comboBox = $request['prestador_representacao'];

        if($comboBox == 0){
            $dadosPrestadorForm = $request->except('_token','prestador_mei');//recebendo dados dos input do formulario
            $representacao = $request['prestador_cnpj'];
            $vinculo = 'CNPJ';
        }else {
            $dadosPrestadorForm = $request->except('_token', 'prestador_cnpj');//recebendo dados dos input do formulario
            $representacao = $request['prestador_mei'];
            $vinculo = 'MEI';
        }

        $cod = Auth::user()->getAuthIdentifier();

        $user =  User::where('id','=',$cod)->get()->first();

        $cliente = Cliente::where('cliente_cod','=',$user['user_vinculo'])->get()->first();

        $dadosPrestadorForm['prestador_nome'] = $cliente['cliente_nome'];
        $dadosPrestadorForm['cliente_id'] = $cliente['cliente_cod'];

        $dadosStore['prestador_nome'] = $cliente['cliente_nome'];
        $dadosStore['cliente_id'] =$cliente['cliente_cod'];
        $dadosStore['prestador_vinculo'] = $vinculo;
        $dadosStore['prestador_representacao'] = $representacao;
        $dadosStore['prestador_descricao'] =$dadosPrestadorForm['prestador_descricao'];

        //mudando padrão de datas..
        $this->validate($request, $this->prestador->rules, $this->messages);//Chamando validação dos dados de entrada
        $insert = $this->prestador->create($dadosStore);//cadastrado no banco de dados

        if ($insert)//se ocorre com sucesso direciona para..
        {
            return redirect('/home')->with('prestOff',true);
        } else return redirect()->back();
    }

    public function edit($id, Request $request)
    {
        $dataForm = $request->except('_token');//recebe dados do formulario

        $this->validate($request,$this->prestador->rulesEdit,$this->messages);//Chamando validação dos dados de entrada
        $update = $this->prestador->where('prestador_cod',$id)->update($dataForm);//alterado a linha selecionada no banco de dados

        if($update)
            return redirect('/prestador/list');
        else return redirect ()->back();
    }

    public function loadPainel()
    {

    }

    public function destroy($id)
    {
        $update = $this->prestador->where('prestador_cod',$id)->update(["prestador_status"=>'0']);

        if($update)//se feito com sucesso direciona para...
            return redirect('/prestador/list');
        else return redirect ()->back();
    }
}
