@extends('app.layouts.basico')

@section('titulo', 'Pedidos')

@section('conteudo')
    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Listagem de Pedidos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{route('pedido.create')}}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:90%; margin-left:auto; margin-right:auto;">
                {{-- {{$pedidos->toJson()}} --}}
                <table border='1' width="100%">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Cliente</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{$pedido->id}}</td>
                                <td>{{$pedido->cliente_id}}</td>
                                <td><a href="{{ route('pedido-produto.create',['pedido'=>$pedido->id]) }}">Adicionar Produtos</a></td>
                                <td><a href="{{ route('pedido.show',['pedido'=>$pedido->id]) }}">Visualizar</a></td>
                                <td>
                                    <form id="form_{{$pedido->id}}" method="post" action="{{route('pedido.destroy',['pedido'=>$pedido->id])}}">
                                        @method('DELETE')
                                        @csrf
                                        <a href="#" onclick="document.getElementById('form_{{$pedido->id}}').submit()">Excluir</a>
                                    </form>
                                </td>
                                {{-- <td><a href="{{ route('pedido.edit',['pedido'=>$pedido->id]) }}">Editar</a></td> --}}
                                {{-- sempre que clico em um link a requisicao eh via get Ok --}}
                            </tr>   
                        @endforeach
                    </tbody>

                </table>
                {{-- {{$pedidos->toJson()}} --}}

                {{-- Detalhes da paginacao abaixo --}}

                {{$pedidos->appends($request)->links()}}
                <!--
                <br>
                {{$pedidos->count()}} - Total de registro por pagina
                <br>
                {{$pedidos->total()}} - Total de registro da consulta
                <br>
                {{$pedidos->firstItem()}} - Numero do primeiro registro da pagina
                <br>
                {{$pedidos->firstItem()}} - Numero do ultimo registro da pagina

                -->
                <br>
                Exibindo {{$pedidos->count()}} pedidos de {{$pedidos->total()}} (de {{$pedidos->firstItem()}} a {{$pedidos->lastItem()}})
                
            </div>
        </div>

    </div>

@endsection