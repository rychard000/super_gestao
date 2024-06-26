<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $primaryKey = 'id';
    
    protected $table = 'produtos';

    protected $fillable = ['id', 'nome', 'unidade', 'descricao', 'peso', 'unidade_id'];

    //1-1 = hasOne = na minha tabela produto_detalhes eu preciso pegar o id da tabela produto, ent eu passo hasOne ou seja 'um para um',como
    //eh so o id, o hasOne ja faz esse relacionamento com produto_detalhes, no caso eh o id da tabela produto
    //⚠️⚠️ A chave estrangeira está no modelo relacionado.

    //N-1 = belongsTo = quando eu tenho 2 registros ou mais na minha tabela, por exemplo ->produto_detalhes uso o belongsTo(pertence a) uso 
    //belognsTo no caso 'muitos para um' no caso 2 registro com id para a tabela produtos, e entao o produto vai ter acesso a ele na tabela,como 
    //se aquelas informacoes estivese ali na table produtos mais na verdadaes estao na produto_detalhes.
    //⚠️⚠️ A chave estrangeira está no próprio modelo que declara o relacionamento.

    //1-N = hasMany =

    //N-N = belongsToMany = 

    public function produtoDetalhe(){

        //Produto tem 1 produtoDetalhe
        return $this->hasOne('App\ProdutoDetalhe'); //o mesmo espera produto_id ou seja nome da tabela + _id
        //ou seja a chave tiver outro nome posso especificar qual ela eh = hasOne('App\ProdutoDetalhe', 'exemplo_chave');

        //Explain: O hasOne vai procurar um registro relacionado em produto_detalhes com base na (foreignKey)=>produto_id
        //produtos (primaryKey) id
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($produto) {
            $produto->produtoDetalhe()->delete();
        });
    }
}