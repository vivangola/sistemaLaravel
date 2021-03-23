<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/', 'Auth\LoginController@index');
Route::resource('/pagamentos', 'PagamentoController');

Route::group(['middleware' => ['auth']], function(){
    
    Route::get('/home', 'HomeController@index');
    Route::get('/logout','Auth\LoginController@logout');
    Route::get('/contas/titular', 'ContaController@getTitular');

    Route::resource('/funcionarios','FuncionarioController');
    Route::resource('/usuarios','UsuarioController');
    Route::resource('/planos','PlanoController');
    Route::resource('/materiais','MaterialController');
    Route::resource('/contas', 'ContaController');
    Route::resource('/estoque', 'EstoqueController');
    Route::resource('/emprestimos', 'EmprestimoController');
    Route::resource('/mensalidades', 'MensalidadeController');
    Route::resource('/obitos', 'ObitoController');
    
});