<?php

namespace App\Http\Middleware;

use App\LogAcesso;
use Closure;

class LogAcessoMiddleware
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
        //$request - manipular
        
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        // LogAcesso::create(['log' => "IP $ip requisitou a rota $rota"]); //vai para o bd

        $resposta = $next($request);

        $resposta->setStatusCode(201, 'O status da resposta e o texto foram modificados!!!');
        return $resposta;

        // return $next($request);//empurra para o proximo middleware,ou se n tive para o controller da rota

        //return Response('Chegamos no middleware e finalizamos no proprio middleware'); //somente a apresentacao do middleware na view 'home'
    }
}
