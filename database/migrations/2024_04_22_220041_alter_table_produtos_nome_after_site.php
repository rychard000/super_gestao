<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProdutosNomeAfterSite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fornecedores', function(Blueprint $table){
            $table->string('site', 150)->after('nome')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fornecedores', function(Blueprint $table){
            // $table->string('site', 150)->after('nome')->nullable(); 
            $table->dropColumn('site');
        });
    }
}

//Reset - Executa o rollback(down) de todas as migrations

//Refresh - Executa o rollback de toas as migrations, logo em seguida executa o migrate para recriar 
//as tabelas la no meu banco de dados

//Fresh - Faz o drop de todos os objetos do banco de dados,⚠️ele nao faz o rollback apenas drop as tabelas do meu banco
//logo em seguida o migrate para recriar as tabelas la no meu banco de dados