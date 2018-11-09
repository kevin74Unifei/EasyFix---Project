<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Vaga;
use DB;

class siteController extends Controller
{
    public function getCidades($idEstado){
        $cidades = DB::select('select * from cidades where estado_id='.$idEstado);        
        return Response::json($cidades);
    }
    
    public function relVagas(){  
        $title = "SISSAR Relatorio de Vagas Paradas";
        $data3 = date('Y/m/d', strtotime('-90 days'));
        $data6 = date('Y/m/d', strtotime('-180 days'));
        $data1Ano = date('Y/m/d', strtotime('-1 years'));
        $data20Ano = date('Y/m/d', strtotime('-20 years'));

        $vaga3m = Vaga::whereBetween('created_at',[$data6,$data3])
                ->where('vag_estado','Livre')
                ->where('vag_active','1')
                ->get();
        $vaga6m = Vaga::whereBetween('created_at',[$data1Ano,$data6])
                ->where('vag_estado','Livre')
                ->where('vag_active','1')
                ->get();
        $vaga1a = Vaga::whereBetween('created_at',[$data20Ano,$data1Ano])
                ->where('vag_estado','Livre')
                ->where('vag_active','1')
                ->get();
        
        return view('painel/relatorioVagasEncalhadas',compact('vaga3m','vaga6m','vaga1a','title'));
    }
}
