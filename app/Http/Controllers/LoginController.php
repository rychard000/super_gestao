<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
   public function index(Request $request){

        $erro = '';

        //$request->get() - pega o parametro passado pela url ou name do input
        if($request->get('erro') == 1){
            $erro = 'Usuario e senha nao existe';
        }

        if($request->get('erro') == 2){
            $erro = 'Necessario realizar login para ter acesso a pagina';
        }
        
        $erro = $request->get('erro');
        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
   }

   public function autenticar(Request $request){

        //regras de validacao
        //'usuario' - nome do input que eu coloquei na view
        //'email' - regra de validacao nativa do laravel
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        //as mensagens de feedback da validacao
        $feedback = [
            'usuario.email' => 'O campo usuario (e-mail) eh obrigatorio',
            'senha.required' => 'O campo senha eh obrigatorio'
        ];

        $request->validate($regras, $feedback);

        //recuperamos os parametros do formulario
        $email = $request->get('usuario');//pegando o valor do input usuario
        $password = $request->get('senha');

        //iniciar o Model User
        $user = new User();
        //vai fazer uma consulta no banco de que se o 'email' da tabela do bd eh igual ao do input que 
        //peguei ali em cima
        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name)){

            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect()->route('app.home');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }

   }

   public function sair(){
        session_destroy();
        return redirect()->route('site.index');
   }
}
