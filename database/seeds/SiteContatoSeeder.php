<?php

use App\SiteContato;
use Illuminate\Database\Seeder;
use Database\Factories\SiteContatoFactory;


class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $contato = new SiteContato();
        $contato->nome = 'Sistema SG';
        $contato->telefone = '(11) 0000-0000';
        $contato->email = 'contato@sg.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Seja bem vindo ao sistema Super Gestao';
        $contato->save();
        */
        
        // factory(SiteContatoFactory::class, 100)->create();
        factory(SiteContato::class, 100)->create();
    }
}
