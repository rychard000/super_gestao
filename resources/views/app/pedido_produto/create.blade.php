@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')

@section('conteudo')
    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Adicionar Produtos ao Pedido<p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{route('pedido.index')}}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <h4>Detalhes do Produto</h4>
            <p>ID do pedido: {{$pedido->id}}</p>
            <p>Cliente: {{$pedido->cliente_id}}</p>

            <div style="width:30%; margin-left:auto; margin-right:auto;">
                <h4>Itens do pedido</h4>
                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>ID:Produto</th>
                            <th>Nome do Produto</th>
                            <th>Data de Criacao</th>
                            <th>Data de Atualizacao</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{$pedido->id}}
                        @foreach ($pedido->produtos as $produto)
                            <tr>
                                <td>{{$produto->id}}</td>
                                <td>{{$produto->nome}}</td>
                                <td>{{$produto->pivot->created_at->format('d/m/Y')}}</td>
                                <td>{{$produto->pivot->updated_at->format('d/m/Y')}}</td>
                                <td>{{$produto->pivot->quantidade}}</td>
                                <td>
                                    <form id="form_{{$produto->pivot->id}}" method="post" action="{{route('pedido-produto.destroy', ['pedidoProduto'=>$produto->pivot->id, 'pedido_id'=>$pedido->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('form_{{$produto->pivot->id}}').submit()">Excluir</a>
                                    </form>    
                                    {{-- Estou pegando o id proprio de cada registro,ou seja cada um tem seu id unico, se fosse pelo id do produto se tivesse dois produtos com id igual,ele iria
                                    excluir os dois dos pedidos,ent para isso eu passo o pivot no model pedido, que esta tendo N-N com a tabela produtos e com pivot pego o id proprio do registro
                                    e quando eu clicar em excluir ele exlui por id e nao pelo id do produto no registro em si --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @component('app.pedido_produto._components.form_create',['pedido'=>$pedido, 'produtos'=>$produtos])
                @endcomponent
            </div>
        </div>

    </div>

@endsection

{{-- <input type="hidden" name="id" value=""> --}}