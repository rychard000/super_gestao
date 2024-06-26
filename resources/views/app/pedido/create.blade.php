@extends('app.layouts.basico')

@section('titulo', 'Pedido')

@section('conteudo')
    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Adicionar Pedido<p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{route('pedido.index')}}">Voltar</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:30%; margin-left:auto; margin-right:auto;">
                @component('app.pedido._components.form_create_edit', ['clientes'=>$clientes])
                {{-- o controller esta passando as inf da variavel cliente e eu estou passando ela para o 
                component do formulario, simples assim --}}
                @endcomponent
            </div>
        </div>

    </div>

@endsection

{{-- <input type="hidden" name="id" value=""> --}}