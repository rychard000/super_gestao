<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\PedidoProduto;
use App\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        //$pedido->produtos; - trazendo a relacao dele com produto atraves do belongsToMany passado no model do mesmo
        return view('app.pedido_produto.create', ['pedido'=>$pedido, 'produtos'=>$produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $request->validate(
        [
            'produto_id'=>'exists:produtos,id',
            'quantidade'=>'required'
        ]
        ,
        [
            'produto_id.exists'=>'O produto informado nao existe',
            'required'=>'O campo :attribute deve possuir um valor valido'
        ]);

       //$pedidoProduto = new PedidoProduto();
       //$pedidoProduto->pedido_id = $pedido->id;
       //$pedidoProduto->produto_id = $request->get('produto_id');
       //$pedidoProduto->quantidade = $request->get('quantidade');
       //$pedidoProduto->save();

       //⚠️❗ Posso salvar os dados na tabela auxiliar do pedido e produto usando o metodo padrao a cima instaciando a classes, e adicionando
       //as novas propriedades para isso tenho que chamar a classe PedidoProduto como de costume para salvar em uma tabela,mas eu posso usar
       //a relacao N-N de pedido e produtos para fazer isso mais facil, basta chamar $pedido que ja esta no parametro no metodo store e acessar
       //o metodo produtos que por sua vez mapeia esse relacionamento com o model Item que instanceia a tabela produtos, agora basta usar o attach 
       //o mesmo permite adicionar informacoes que devem ser inseridas a tabela auxiliar que guarda o relacionamente N-N entre os models 'pedidos' e 'produtos'
       //para isso ele associa o produto especifico "$request->get('produto_id') =>" ao pedido com uma quantidade especifica "['quantide' => $request->get('quantidade')]"

       //⚠️ no $pedido->produtos()->attach tenho que passar o 'produto_id' pois 'pedido_id' ja esta instaciado pelo model 'Pedido', por isso ele nao tem o 'produto_id'
       //ent tenho que passar ele como parametro,Se eu está adicionando vários produtos a um pedido específico, faz sentido trabalhar no contexto do Pedido. para eu usar
       //o metod attach,igual eu estou fazendo aqui. Igual fazendo na mao chamando o model e inserindo, fiz os exemplos nas 2 linhas abaixo
       //$pedidoProduto->pedido_id = $pedido->id;
       //$pedidoProduto->produto_id = $request->get('produto_id'); 

       //EXEMPLO AO CONTRARIO
       //$item->pedidos()->attach([$request->get('pedido_id') => ['quantidade' => $request->get('quantidade')]]);

       //⚠️$pedido->produtos()->attach(<id_protudo>,<coluna para guardar os dados>); //objeto
       //$pedido->produtos()->attach($request->get('produto_id'), ['quantidade'=>$request->get('quantidade')]);
       //OU
       $pedido->produtos()->attach([ $request->get('produto_id') => ['quantidade' => $request->get('quantidade')] ]);
        
       return redirect()->route('pedido-produto.create',['pedido'=>$pedido->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int PedidoProduto $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Pedido $pedido, Produto $produto)
    //PedidoProduto - tipagem
    //$pedidoProduto - proprio parametro em si
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // print_r($pedido->getAttributes());
        // echo '<hr>';
        // print_r($produto->getAttributes());

        // echo $pedido->id.'-'.$produto->id;
        //------------------------------------//

        //1 - Metodo where
        // PedidoProduto::where(['pedido_id'=>$pedido->id, 'produto_id'=>$produto->id])->delete();

        //2 - Metodo detach - ao contrario do attach que adiciona registros atraves de relacionamentos entre as tabelas 'N-N',ele deleta
        //pelo relacionamento adicionado no model 'pedido'
        //Poderia tambem deletear registros ao contrario ou seja $item->pedidos()->detach($pedido->id);
        // $pedido->produtos()->detach($produto->id);

        $pedidoProduto->delete();

        //⚠️ Como 'pedido_id' ja eh uma informacao pertencente ao pedido->prdutos()
        //O mesmo remove por exemplo pedido_id = 1, produto_id = 4, ele remove esse registro apagando tbm sua quantidade, um delete normal

        return redirect()->route('pedido-produto.create',['pedido'=>$pedido_id]);
    }
}
