<?php

use Illuminate\Support\Facades\Route;
use App\Cliente;
use App\Endereco;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach($clientes as $cliente)
    {
        echo "<p> ID: ". $cliente->id."</p>";
        echo "<p> Nome: ". $cliente->nome."</p>";
        echo "<p> Telefone: ". $cliente->telefone."</p>";
        echo "<p> Rua: ". $cliente->endereco->rua."</p>";
        echo "<p> Numero: ". $cliente->endereco->numero."</p>";
        echo "<p> Bairro: ". $cliente->endereco->bairro."</p>";
        echo "<p> Cidade: ". $cliente->endereco->cidade."</p>";
        echo "<p> UF: ". $cliente->endereco->uf."</p>";
        echo "<p> CEP: ". $cliente->endereco->cep."</p>";
        echo "<hr>";
    }
});

Route::get('/novocliente', function () {
    $c = new Cliente();
    $c->nome = "Denison";
    $c->telefone = "12 2234-4432";
    $c->save();

    $e = new Endereco();
    $e->rua = "Av. do Brasil";
    $e->numero = 1500;
    $e->bairro = "Jardim Olivia";
    $e->cidade = "São Paulo";
    $e->uf = "SP";
    $e->cep = "11123-332";

    $c->endereco()->save($e);
});

Route::get('/clientes/json', function () {
    // $clientes = Cliente::all();
    $clientes = Cliente::with('endereco')->get();
    return $clientes->toJson();
});
