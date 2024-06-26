<?php

namespace App;
//Os models no Laravel são classes PHP que representam e interagem com as tabelas
//do banco de dados. Eles são uma parte fundamental do Eloquent ORM (Object-Relational Mapping) do Laravel

//Os models representam tabelas do banco de dados como objetos PHP. Cada instância de um model representa uma linha na tabela correspondente.

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;
    protected $table = 'fornecedores';
    //quando o plural for 'es' no final no caso do portugues, indica ao laravel a tabela no plural
    //pq 'fornecedors' ia ficar ortograficamente errado do no portugues, pois o laravel so adiciona o 's'
    //no final do nome
    protected $fillable = ['nome', 'site', 'uf', 'email'];
    //usando o $fillable passa um array com os registros que eu quero e passo eles em forma de array associativo
    //usanso \App\Fornecedor::create([....])

    //Fornecedor::all() - para ver os registros do banco na tabela fornecedor, todos os registros nas colounas id,nome,
    //site, etc...

    //Fornecedor::find() - dentrdo dos (2) do find passo o id do registro que quero ver, ou posso passar um array ([1, 2, 3, 4])
    //e entao ele me mostra todos os registros de acordo com que eu passar

    //$contatos = SiteContato::where('id', '>', 1)->get(); Where - Metodo where eh um construtor que acha registros atraves do parametro
    //passsado, 'coluna', 'valor', operador. Metodo get eh para ele achar os requisitor ja que se passar sem um get ele retorna um builder
    //sem o valor obvio
    //Operador aceitos no where
    // > Maior
    // >= Maior ou igual
    // < Menor
    // <= Menor ou igual
    // <> Diferente
    //== Igual
    // like
    //$contatos = SiteContato::where('id', '>', 1)->get(); Neste caso ele ira mostrar os registros maiores que 1 ou seja do id 2 para cima
    //$contatos = SiteContato::where('nome', '<>', 'Maria')->get(); - Ira mostrar os registros na tabela diferente de Maria
    //$contatos = SiteContato::where('name', 'Maria')->get(); - Neste caso o operador == ira fazer efeito aqui,ele ira mostar o registro nas
    //tabelas que sao igual a maria,mais nao precisa passar o == como callback 

    //$contatos = SiteContato::where('mensagem', 'like', 'Estou%')->get(); - Like serve para procurar uma palavara na coluna da tabela, % indica
    //que pode haver qualquer coisa a direita ou seja uma outra palavra, se tiver somente %Estou indica que pode haver algo na esquerda se for 
    //%estou% significa que pode haver algo em qualquer ambos os lados

    //$contatos = SiteContato::whereIn('motivo_contato', [1, 3])->get(); - whereIn me devolve os registros que tem o 1 e 3 na tabela motivo_contato;
    //whreNotIn = eh o contrario de tudo ele me devolve os registros diferentes de [1, 3] ou seja no caso somente o 2

    //$contatos = SiteContato::whereBetween('id', [3, 6])->get(); - whereBetween me devolve os registros entre 3 e 6 da tabela id, inclusive os mesmos 
    //whereNotBetwen - mesma coisa so que o contrario 

    //USANDO operador AND
    //select * from site_contatos where nome <> 'Fernando' and motivo_contato in (1, 2) and created_at between '2024-04-01 00:00:00' and '2024-04-30 23:59:59';
    // $contatos = SiteContato::where('nome', '<>' 'Fernando')->whereIn('motivo_contato', [1,2])->whereBetween('created_at', ['2024-04-01 00:00:00', '2024-04-30 23:59:59'])->get();
    //Posso usar tbm todos esses metodotos construtores chamando mais de um e usando o get no final. Linha 50 eh como fica no MySql e na 51 eh como fica no Eloquent

    //USANDO operador OR
    //select
    //    * 
    //from
    //    site_contatos
    //where
    //    nome <> 'Fernando'
    //    or motivo_contato in (1, 2)
    //    or created_at between '2024-04-01 00:00:00' and '2024-04-30 23:59:59';
    //$contatos = SiteContato::where('nome', '<>' 'Fernando')->orWhereIn('motivo_contato', [1,2])->orWhereBetween('created_at', ['2024-04-01 00:00:00', '2024-04-30 23:59:59'])->get();
    //No caso do or, sera registros que se caixam em uma das condicoes passadas, ⚠️caso nao for passado o or entre um dos construtores o padarao sera o operador and
    
    //$contatos = SiteContato::whereNotNull('updated_at')->get(); era me retornar os registros da tabela updated_at nao for nulo
    //$contatos = SiteContato::whereNull('updated_at')->get(); mesma coisa mais ao contrario

    //Posso usar o operador or para unir os dois ou and por padrao usando ->
    //$contatos = SiteContato::whereNotNull('updated_at')->orWhereNull('created_at')->get(); //EXMEPLO DE OR
    //$contatos = SiteContato::whereNotNull('updated_at')->WhereNull('created_at')->get(); //EXEMPLO AND

    //$contatos = SiteContato::where(function($query){$query->where('nome','jorge')->orWhere('nome', 'Ana');})->where(function($query){$query->whereIn('motivo_contato', [1,2])->orWhereBetween('id', [4, 6]);})->get();
    //dentro do where podemos ter uma decisao do or para todo o where ser true usando a function query do proprio where

    public function produtos(){
        return $this->hasMany('App\Item', 'fornecedor_id', 'id');
    }
}
