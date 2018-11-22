<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/home', function () {
    return view('painel/userView');    
});
Route::get('/candidatohome','CandidatoController@loadPainel');

Route::get('/clientehome','ClienteController@loadPainel');

Route::get('/rel',"siteController@relVagas" );

Route::get('/', function () {
    return view('loginSystem');
})->middleware("CheckUser");

Route::post('/logar', 'UserController@login');
Route::get('/logout','UserController@logout');
Route::post('/testPass','UserController@testPass');

Route::get('/funcionario/list','FuncionarioController@index');//->middleware("CheckUserAdmin");

Route::get('/funcionario/form/{id?}','FuncionarioController@create');//->middleware("CheckUserAdmin");

Route::get('funcionario/show/{id}','FuncionarioController@show')->middleware("CheckUserAdmin");
        
Route::post('funcionario/cadastrar','FuncionarioController@store');//->middleware("CheckUserAdmin");

Route::post('funcionario/edit/{id}','FuncionarioController@edit')->middleware("CheckUserAdmin");

Route::get('funcionario/delete/{id}','FuncionarioController@destroy')->middleware("CheckUserAdmin");

    
Route::get('cidades/{idEstado}', "siteController@getCidades");


Route::get('/usuario/list','UserController@index');

Route::get('/usuario/cadastro/{ent}/{id}', 'UserController@create');

Route::post('/usuario/cadastrar/', 'UserController@store');

Route::get('/usuario/formeditor/{id}','UserController@editor');

Route::post('usuario/edit/{id}','UserController@edit');

Route::get('usuario/delete/{ent}/{id}','UserController@destroy');




Route::get('/candidato/form/{id?}','CandidatoController@create');

Route::post('/candidato/cadastrar','CandidatoController@store');

Route::get('/candidato/list','CandidatoController@index');

Route::get('candidato/delete/{id}','CandidatoController@destroy');

Route::get('candidato/show/{id}','CandidatoController@show');

Route::post('candidato/edit/{id}','CandidatoController@edit');


Route::get('/cliente/form/{id?}','ClienteController@create');

Route::post('/cliente/cadastrar','ClienteController@store');

Route::get('/cliente/list','ClienteController@index');

Route::get('cliente/delete/{id}','ClienteController@destroy');

Route::get('cliente/show/{id}','ClienteController@show');

Route::post('cliente/edit/{id}','ClienteController@edit');


Route::get('/empresa/form/{id?}', 'EmpresaController@create')->middleware("CheckUserAdmin");

Route::post('/empresa/cadastrar','EmpresaController@store')->middleware("CheckUserAdmin");

Route::get('/empresa/list', 'EmpresaController@index')->middleware("CheckUserAdmin");

Route::get('/empresa/show/{id}','EmpresaController@show')->middleware("CheckUserAdmin");

Route::post('/empresa/edit/{id}','EmpresaController@edit')->middleware("CheckUserAdmin");

Route::get('/empresa/delete/{id}','EmpresaController@destroy')->middleware("CheckUserAdmin");


Route::get('/vaga/form/{id?}', 'VagaController@create');

Route::post('/vaga/cadastrar','VagaController@store');

Route::get('/vaga/list', 'VagaController@index');

Route::get('/vaga/show/{id}','VagaController@show');

Route::post('/vaga/edit/{id}','VagaController@edit');

Route::get('/vaga/delete/{id}','VagaController@destroy');


Route::get('/curriculo/form/{id}', 'CurriculoController@create');

Route::post('/curriculo/gerar', 'CurriculoController@store');

Route::get('/curriculo/view/{id}', 'CurriculoController@show');

Route::get('/curriculo/delete/{id}', 'CurriculoController@destroy');



Route::get('/entrevista/form/{id?}', 'EntrevistaController@create');

Route::post('/entrevista/cadastrar','EntrevistaController@store');

Route::get('/entrevista/list', 'EntrevistaController@index');

Route::get('/entrevista/show/{id}','EntrevistaController@show');

Route::post('/entrevista/edit/{id}','EntrevistaController@edit');

Route::get('/entrevista/delete/{id}','EntrevistaController@destroy');


Route::get('/pagamento/form/{id?}', 'PagamentoController@create');

Route::post('/pagamento/cadastrar','PagamentoController@store');

Route::get('/pagamento/list', 'PagamentoController@index');

Route::get('/pagamento/show/{id}','PagamentoController@show');

Route::post('/pagamento/edit/{id}','PagamentoController@edit');

Route::get('/pagamento/delete/{id}','PagamentoController@destroy');

Route::get('/prestador/form/{nome?}','PrestadorController@create');

Route::post('/prestador/cadastrar','PrestadorController@store');

Route::get('/prestador/list', 'PrestadorController@index');

Route::get('/prestador/show/{id}','PrestadorController@show');

Route::post('/prestador/edit/{id}','PrestadorController@edit');

Route::get('/prestador/delete/{id}','PrestadorController@destroy');
