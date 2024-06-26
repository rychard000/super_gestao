<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeToForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['fornecedor_id']);
            $table->foreign('fornecedor_id')
                  ->references('id')
                  ->on('fornecedores')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['fornecedor_id']);
            $table->foreign('fornecedor_id')
                  ->references('id')
                  ->on('fornecedores');
        });
    }
}