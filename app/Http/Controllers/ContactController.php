<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContactController extends Controller
{
    public function contact(Request $request){
        
        // echo '<pre>';
        // print_r($request->all());
        // echo '<pre>';
        // echo $request->input('nome');
        // echo '<br>';
        // echo $request->input('email');
        
        // $contato = new SiteContato();
        // $contato->nome = $request->input('nome');
        // $contato->telefone = $request->input('telefone');
        // $contato->email = $request->input('email');
        // $contato->motivo_contato = $request->input('motivo_contato');
        // $contato->mensagem = $request->input('mensagem');
        // $contato->save();

        // $contato = new SiteContato();
        // $contato->fill($request->all());
        // $contato->save();
        
        // print_r($request->all());

        $motivo_contato = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato', 'motivo_contato' => $motivo_contato]);
    }

    public function salvar(Request $request){

        // dd($request->all());
        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos', //nome com 3 caracteres e no maximo 40 e unique:site_contatos eh a tabela la no bd 
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa ter no minimo 3 caracteres', 
            'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
            'nome.unique' => 'O nome informado ja esta em uso',
            
            'email.email' => 'O email informado nao eh valido',

            'mensagem.max' => 'A mensagem deve ter no maximo 2000 caracteres',

            //valor padrao para todos que nao tiverem o required setado ex:nome.required,o nome ja tem setado ent nao conta
            'required' => 'O campo :attribute deve ser preenchido'
        ]; 

        $request->validate($regras, $feedback);

        SiteContato::create($request->all()); //salva no bd

        return redirect()->route('site.finish');
    }
}
