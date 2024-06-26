<div class="topo">

    <div class="logo">
        {{-- Asset sempre aponta para a pasta public da aplicacao --}}
        <a href="{{ route('site.index') }}"><img style="cursor:pointer;" src="{{ asset('img/logo.png') }}"></a>
        {{-- <img style="cursor:pointer;" src="{{ asset('img/logo.png') }}"> --}}
    </div>

    <div class="menu">
        <ul>
            <li><a href="{{ route('site.index') }}">Principal</a></li>
            <li><a href="{{ route('site.sobrenos') }}">Sobre Nós</a></li>
            <li><a href="{{ route('site.contato') }}">Contato</a></li>
            <li><a href="{{ route('site.login') }}">Login</a></li>
        </ul>
    </div>
</div>