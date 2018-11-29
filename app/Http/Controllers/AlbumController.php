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

    public function index(Request $request)
    {
return view('crud-album/AlbumList');
    }

    public function create()
    {
return view('crud-album/AlbumForm');
    }

    public function show($id)
    {

    }

    public function store(Request $request)
    {

    }

    public function edit($id, Request $request)
    {

    }

    public function loadPainel()
    {

    }

    public function destroy($id)
    {

    }
}
