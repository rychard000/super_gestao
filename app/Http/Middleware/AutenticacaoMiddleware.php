<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        session_start();

        if(isset($_SESSION['email']) && $_SESSION['email'] != ''){
            return $next($request);
        }else{
            return redirect()->route('site.login', ['erro' => 2]);
        }

        // $br = '<br>';
        // echo "$metodo_autenticacao $br";

        // //$metodo_autenticacao
        // if($metodo_autenticacao == 'padrao'){
        //     echo "Verificar o usuario e senha no banco de dados $br";
        // }

        // if($metodo_autenticacao == 'ldap'){
        //     echo "Verificar o usuario e senha no AD $br";
        // }

        // //$perfil
        // if($perfil == 'visitante'){
        //     echo "Exibir apenas alguns recursos $br";
        // }else{
        //     echo 'Carregar o perfil do banco de dados';
        // }

        // if($metodo_autenticacao == 'ldap'){
        //     echo "Verificar o usuario e senha no AD $br";
        // }

        // //verifica se o usuario possui acesso a rota
        // if(false){
        //     return $next($request);//vai empurrar para o controller da rota
        // }else{
        //     return Response('Acesso negado! Rota exige autenticacao!!!');
        // }
    }
}
