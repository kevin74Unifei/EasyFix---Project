<?php

namespace App\Http\Controllers;

use App\Album;
use App\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Prestador;
use App\User;
use App\Curriculo;
use DB;

class AlbumController extends Controller
{
    private $album;

    private $messages = [//mensagens que serão exibidas quando a validação falhar
    ];

    public function __construct(Album $a)
    {
        $this->album = $a;
    }

    public function index()
    {
        $idUser = Auth::user()->getAuthIdentifier();
        $dadosAlbumArray = $this->album->where('prestador_id',$idUser)->get();
                
        return view('crud-album/AlbumList')->with('dadosAlbumArray',$dadosAlbumArray);
    }

    public function create()
    {
        $idUser = Auth::user()->getAuthIdentifier();

        return view('crud-album/AlbumForm')->with('idUser',$idUser);
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {        
        $this->validate($request,$this->album->rules,$this->messages);//Chamando validação dos dados de entrada
        
        $dadosClienteForm = $request->except('_token');//recebendo dados dos input do formulario
        
        if($request->hasFile('path')){//Se existir imagem faz upload e armazena   
            $imagem = $request->file('path');
            $ext=$imagem->getClientOriginalExtension();            
            $filename = md5(time()).".".$ext;//Criando um nome que não será repetido
            $request->path->storeAs('/album/', $filename); 
            $dadosClienteForm['path'] = $filename;
        }

        $insert = $this->album->create($dadosClienteForm);//cadastrado no banco de dados 
        
        if($insert)//se ocorre com sucesso direciona para..
        {
           return redirect('/album/list'); 
        }
        else return redirect ()->back();
    }

    public function edit($id, Request $request)
    {

    }

    public function destroy($id)
    {
        $delete = $this->album->find($id)->delete();
        if($delete)//se ocorre com sucesso direciona para..
        {
           return redirect('/album/list'); 
        }
        else return redirect ()->back();
    }
}
