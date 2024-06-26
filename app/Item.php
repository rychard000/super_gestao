<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'produtos';

    protected $fillable = ['id', 'nome', 'unidade', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe(){
       
        return $this->hasOne('App\ItemDetalhe', 'produto_id', 'id');
        //primaryKey = id da tabela produto
        //foreignKey = produto_id que pega o id e armazena no produto_detalhes 
    }

    public function fornecedor(){
        return $this->belongsTo('App\Fornecedor');  
    }

    public function pedidos(){
        return $this->belongsToMany('App\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');
        //tabela N-N = pedidos_protudos
        //se o nome do model fosse 'Produto' apenas isso seria o suficiente = return $this->belongsToMany('App\Pedido', 'pedidos_protudos');
        //o nome ja iria se conectar a tabela,tudo por conta da inteligencia do laravel

        //3 - Representa o nome da FK da tabela mapeada pelo model na tabela de relacionamento, ou seja o id de produto viaja como FK para 
        //a tabela 'pedidos_produtos' com o nome de 'produto_id'
        //4 - Representa o nome da FK da tabela mapeada pelo model ultilizado no relacionamento que estamos implementando, basicamente a mesma
        //coisa que o '3' parametro,mas esse parametro eh FK da tabela que estou passando para o belongsToMany no caso a tabela 'pedidos',
        //o mesmo eh a FK da tabela pedidos que viaja como FK para a tabela 'pedidos_produtos' com o nome de 'pedido_id'

        //⚠️❗ Em uma relacao N-N de duas tabelas preciso fazer o metodo belogsTomany nos 2 models no caso 'Pedido' e 'Item|que mapeia a tabela produtos'
        //e passando os mesmos parametros para ambos, claro tambem a tabela auxiliar 'pedidos_produtos'
    }
}
