@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')

@section('conteudo')
    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar<p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{route('app.fornecedor.adicionar')}}">Novo</a></li>
                <li><a href="{{route('app.fornecedor')}}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:90%; margin-left:auto; margin-right:auto;">

                <table border='1' width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>E-mail</th>
                            <th>Excluir</th>
                            <th>Editar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{$fornecedor->nome}}</td>
                                <td>{{$fornecedor->site}}</td>
                                <td>{{$fornecedor->uf}}</td>
                                <td>{{$fornecedor->email}}</td>
                                <td><a href="{{route('app.fornecedor.excluir', $fornecedor->id)}}">Excluir</a></td>
                                <td><a href="{{route('app.fornecedor.editar', $fornecedor->id)}}">Editar</a></td>
                                {{-- sempre que clico em um link a requisicao eh via get Ok --}}
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <p>Lista de produtos</p>
                                    <table border="1" style="margin:20px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{$fornecedor->produtos->toJson()}} --}}
                                            @foreach ($fornecedor->produtos as $key => $produto)    
                                                <tr>
                                                    <th>{{$produto->id}}</th>
                                                    <th>{{$produto->nome}}</th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>

                </table>

                {{$fornecedores->appends($request)->links()}}
                <!--
                <br>
                {{$fornecedores->count()}} - Total de registro por pagina
                <br>
                {{$fornecedores->total()}} - Total de registro da consulta
                <br>
                {{$fornecedores->firstItem()}} - Numero do primeiro registro da pagina
                <br>
                {{$fornecedores->firstItem()}} - Numero do ultimo registro da pagina

                -->
                <br>
                Exibindo {{$fornecedores->count()}} fornecedores de {{$fornecedores->total()}} (de {{$fornecedores->firstItem()}} a {{$fornecedores->lastItem()}})
                
            </div>
        </div>

    </div>

@endsection