<?php

namespace App\Http\Controllers;

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
        $title = "EasyFix";
    }

    public function create($prestador_cod = null)
    {
        $ent = "prestador";

        if ($prestador_cod != null) {//Se recebe um parametro, faz o que esta aqui dentro
            $title = "EasyFix";
            $dadosPrestador = $this->prestador->where("prestador_cod", $prestador_cod)->get();
            foreach ($dadosPrestador as $d) {
                $resp = [//guarda dados em um vetor com nomes genericos para ser utilizado pelo components-templates
                    'prestador_id' => $d['prestador_cod'],
                    'prestador_tipo' => $d['prestador_tipo'],
                    'prestador_representacao' => $d['prestador_representacao'],
                    'prestador_mei' => $d['prestador_mei'],
                    'prestador_cnpj' => $d['prestador_cnpj'],
                    'prestador_descricao' => $d['prestador_descricao'],
                    'prestador_tipo' => $d['prestador_tipo']
                ];

                break;
            }//Retorna um formulario para alteração de dados.

            return view('crud-prestador/PrestadorForm', compact("title", "ent", "resp"));
        } else {//Se não tiver parametros retorna um formulario basico de cadastro
            $title = "EasyFix";
            $ent = "prestador";

            return view('crud-prestador/PrestadorForm', compact("title", "ent", "dadosEmpresas"));
        }
    }

    public function show($id)
    {
        $dadosCliente = $this->prestador->where("prestador_cod", $id)->get()->first();

        $title = "EasyFix" . $dadosCliente['prestador_nome'];
        return view('crud-prestador/prestadorView', compact("title", "dadosCliente"));
    }

    public function store(Request $request)
    {
        $dadosPrestadorForm = $request->except('_token');//recebendo dados dos input do formulario

        //mudando padrão de datas..
        $this->validate($request, $this->prestador->rules, $this->messages);//Chamando validação dos dados de entrada
        $insert = $this->prestador->create($dadosPrestadorForm);//cadastrado no banco de dados

        if ($insert)//se ocorre com sucesso direciona para..
        {
            return redirect('/usuario/cadastro/prestador/' . $insert['id']);
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
