<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Super Gestao - @yield('titulo')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}">
    </head>

    <body>
        @include('app.layouts._partials.topo')
        {{-- Como as 3 views estao usando o mesmo nome ambas sao extendidas todas de uma vez como se fosse assim em html:
        <section>sobre-nos</section>
        <section>principal</section>
        <section>contato</section> --}}
        @yield('conteudo')
    </body>
</html>