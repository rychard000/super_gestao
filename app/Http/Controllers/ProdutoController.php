<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Item;
use App\Produto;
use App\ProdutoDetalhe;
use App\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //GET
    public function index(Request $request)
    {
        $produtos = Item::with(['itemDetalhe'])->paginate(10);

        // foreach ($produtos as $key => $produto) 
        //     // print_r($produto->getAttributes());
        //     // echo '<br><br>';

        //     //aonde o produto id da table ProdutoDetalhe eh igual a o id do produto na table Produtos
        //     $produtoDetalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();
        //     //collection ProdutoDetalhe

        //     //ProdutoDetalhe
        //     if(isset($produtoDetalhe)){
        //         // print_r($produtoDetalhe->getAttributes());

        //         $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
        //         $produtos[$key]['largura'] = $produtoDetalhe->largura;
        //         $produtos[$key]['altura'] = $produtoDetalhe->altura;
        //     }
        //     // echo '<hr>';
        // }

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //GET
    public function create()
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //POST
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required|min:3|max:40',
            'descricao'=>'required|min:3|max:2000',
            'peso'=>'required|integer',
            'unidade_id'=>'exists:unidades,id',
            'fornecedor_id'=>'exists:fornecedores,id'
            //'unidade_id'=>'exists:<tabela>,<coluna>'
        ],
        [
            'required'=>'O campo attribute deve ser preenchido',
            'nome.min'=>'O campo nome deve ter no minimo 3 caracteres',
            'nome.max'=>'O campo nome deve ter no maximo 40 caracteres',
            'descricao.min'=>'O campo descricao deve ter no minimo 3 caracteres',
            'descricao.max'=>'O campo descricao deve ter no maximo 2000 caracteres',
            'peso.integer'=>'O campo peso deve ser um numero inteiro',
            'unidade_id.exists'=>'A unidade de medida informada nao existe'
        ]);

        Item::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    //GET
    public function show(Produto $produto)
    {   
        return view('app.produto.show',['produto'=>$produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    //GET
    public function edit(Produto $produto)
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.edit',['produto'=>$produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
        // return view('app.produto.create',['produto'=>$produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    //PUT||PATCH
    public function update(Request $request, Item $produto)
    {
        $request->validate([
            'nome'=>'required|min:3|max:40',
            'descricao'=>'required|min:3|max:2000',
            'peso'=>'required|integer',
            'unidade_id'=>'exists:unidades,id',
            'fornecedor_id'=>'exists:fornecedores,id'
        ],
        [
            'required'=>'O campo attribute deve ser preenchido',
            'nome.min'=>'O campo nome deve ter no minimo 3 caracteres',
            'nome.max'=>'O campo nome deve ter no maximo 40 caracteres',
            'descricao.min'=>'O campo descricao deve ter no minimo 3 caracteres',
            'descricao.max'=>'O campo descricao deve ter no maximo 2000 caracteres',
            'peso.integer'=>'O campo peso deve ser um numero inteiro',
            'unidade_id.exists'=>'A unidade de medida informada nao existe',
            'fornecedor_id.exists'=>'O fornecedor informado nao existe'
        ]);

        //$request->all() //Instancia do objeto no atual(atualizado)
        //$produto //Instancia do objeto no estado anterior

        // print_r($request->all()); 
        // echo '<br><br><br>';
        // print_r($produto->getAttributes());

        // dd($request->all());
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    //DELETE
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
