<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = ['id', 'cliente_id'];

    public function produtos(){
        // return $this->belongsToMany('App\Produto', 'pedidos_produtos');

        return $this->belongsToMany('App\Item', 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at', 'quantidade');

        //1 - Model N-N ao mo model que estou implementando
        //2 - Eh a tabela auxiliar que armazena os registros de relacionamento
        //3 - Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
        //4 - Representa o nome da FK da tabela mapeada pelo model ultilizado no relacionamento que estou implementando

        //⚠️❗ Em uma relacao N-N de duas tabelas preciso fazer o metodo belogsTomany nos 2 models no caso 'Pedido' e 'Item|que mapeia a tabela produtos'
        //e passando os mesmos parametros para ambos, claro tambem a tabela auxiliar 'pedidos_produtos'
    }
}
