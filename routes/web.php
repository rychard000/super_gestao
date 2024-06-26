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

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Support\Facades\Route;

//MYSQL RELACOES⚠️⚠️⚠️⚠️⚠️
//1/1 = Um registro de um tabela esta relacionada com outro registo de outra tabela 
//1/n = Um registro de uma table esta relacionando com muitos registros de outras tabelas
//n/m = Muitos registros de tabela esta relacionado a outros registros de muitas tabelas

//⚠️Class::falar() = os :: significa que estou puxando metodos estaticos

//⚠️php artisan serve => isso vai subir o server igual no react,so que la eh npm run dev
//⚠️Para criar um nova rota posso criar um classe usando o seguinte comando no terminal:
//php artisan make:controller PrincipalController
//isso faz com que um novo arquivo php eh criado e nele ja tem um classo com o nome que passei depois de make:controller

//Segundo callback eh a classe e o principal e a funcao view() que a mesma retorna dentro desta view() ela esta puxando
//um arquivo blade que por sua vez retorna um h3 por exemplo

//⚠️ Logica de mais ou menos como funciona as rotas para onde ela vai
//Routas(Parametros)-------Controllers---------View

//❗ Os names so podem ser usados dentro da aplicacao, na barra de pesquisa usa-se,Contact,About,Login,etc..
//eh sempre bom passar um name() caso o acessador mude de nome,o name() ira sempre ser este, site.index por exemplo
//eh so uma boa pratica para nomear rotas, pode ser qualquer nome por exemplo: 'abcd' ,iria funcionar tambem

//Rotas Publicas:

Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/finish', 'FinishController@finish')->name('site.finish');

Route::get('/About', 'AboutController@about')->name('site.sobrenos');

Route::get('/Contact', 'ContactController@contact')->name('site.contato');
Route::post('/Contact', 'ContactController@salvar')->name('site.contato');

//⚠️❗ Nesta rota estou lindando com formulario real, ent tenho que ter a mesma rota para post e get, como por padrao todas
//as rotas sao get, tenho q ter um metodo post para lidar com o formulario que vai ser mandado para o banco
Route::get('/Login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/Login', 'LoginController@autenticar')->name('site.login');

//Rotas Restritas:

//Para deixar as rotas restricas,usa do objeto Route um metodo chamado prefix,ele faz o agrupamento de rotas
//->/app eh usado para ser o acessador do grupo de rotas, exemplo: http://127.0.0.1:8000/app/Clientes
Route::middleware('autenticacao')->prefix('/app')->group(function(){

    Route::get('/Home', 'HomeController@index')->name('app.home');
    Route::get('/Sair', 'LoginController@sair')->name('app.sair');
    // Route::get('/Cliente', 'ClienteController@index')->name('app.cliente');

    Route::get('/Fornecedor', 'FornecedorController@index')->name('app.fornecedor');

    Route::post('/Fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/Fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');

    Route::get('/Fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/Fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    
    Route::get('/Fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/Fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');

    Route::resource('produto', 'ProdutoController');
    Route::resource('produto-detalhe', 'ProdutoDetalheController');
    Route::resource('cliente', 'ClienteController');
    Route::resource('pedido', 'PedidoController');
    // Route::resource('pedido-produto', 'PedidoProdutoController');

    Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
    Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
    // Route::delete('pedido-produto.destroy/{pedido}/{produto}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
    Route::delete('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
});

//------------------------------------//

//Redirecionamento de rotas

//O redirecionamento de rotas eh muito simples,quando eu acessar a 'rota2' => 127.0.0.1:8000/rota2
//ele me manda na hora para o 'rota1' => 127.0.0.1:8000/rota1

Route::get('/rota1', function(){
    echo 'Rota1';
})->name('site.rota1');

Route::get('rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');

//----------------------------------------//

//FallBack

//Quando o usuario acessar uma rota noa existe por exemplo: 'http://127.0.0.1:8000/alal' na aplicaco posso redirecionar
//o mesmo para uma rota em vez de aparecer a padaro de erro 404, 
Route::fallback(function(){{
    echo 'A rota acessada nao existe. <a href="'.route('site.index').'">clique aqui</a> para ir para a pagina principal';
}});

//----------------------------------------//

//Parametros de rota

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

//⚠️ O pametro da rota eh passado depois da barra, na funcao ela va ter parametros que sao os mesmos das rotas,ent se na rota
//tiver 4 parametros a funcao de callback tera 4 parametros tbm,nao precisa ser o mesmo nome,mais eh bom para deixar melhor a 
//visibilidade do codigo

//Posso tambem deixar parametros opcionais usando '?' caso ele nao receba nada, ele tem um valor padrao usando =, igual no react nas props
//Posso tambem deixar todos os parametros opcionais
// Route::get(
//     '/Contact/{nome?}/{categoria?}/{assunto?}/{mensagem?}',
//     function(
//         string $nome = 'Desconhecido',
//         string $categoria = 'Informacao',
//         string $assunto = 'Contato',
//         string $mensagem = 'Nao informado'
//     ){
//         echo "Estamos aqui: $nome - $categoria - $assunto - $mensagem";
// });

// Route::get(
//     '/Contact/{nome}/{categoria_id}',
//     function(
//         string $nome = 'Desconhecido',
//         int $categoria = 1
//     ){
//         echo "Estamos aqui: $nome - $categoria";
        
// })->where('nome', '[A-Za-z]+')->where('categoria_id', '[0-9]+');
//Os parametros se nao atenderem a condicao passada no where,por exemplo que tem que ser de A-Z ou a-z, e na categoria
//de 0 a 9 e o '+' significa que tem q ser no minimo 1 carater do mesmo,a rota nao eh processada 404