<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LogAcessoMiddleware;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct(){
        // $this->middleware(LogAcessoMiddleware::class);
        $this->middleware('log.acesso');
    }

    public function about(){
        //⚠️O nome da chave 'titulo' tem q ser o mesmo que a variavel la na view
        return view('site.sobre-nos', ['titulo' => 'Sobre-Nos']);
    }
}
