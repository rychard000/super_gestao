<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    //Nao eh necessario passar o mesmo nome dos pametros aqui na class,por exemplo la na rota
    //tem $p1 e $p2, mas o mais importante e a sequencia dos mesmo e nao o nome, ent poderia muito
    //bem ser $a, $b .Que iria funcionar do mesmo jeito
    public function teste(int $p1, int $p2){
        // echo "A soma de $p1 + $p2 eh: ". ($p1 + $p2);

        //Array associativo - O indice pode ser qualquer valor,pois no teste.blade.php ele vai ser a variavel em questao e
        //podendendo ser chamada usando {{$x}}, este eh metodo view para passar parametro para a view diretamente
        //do controller, na view teste a variavel x vai ter o valor de $p1
        // return view('site.teste', ['x' => $p1, 'y' => $p2]);

        //compact() - Cria um array associativo tbm,mais tenho q passar exatamente o nome das variavel em string sem o $
        // return view('site.teste', compact('p1', 'p2'));

        //with() - O primeiro valor vai receber o valor de $p1 por exemplo e la na view teste basta chamar o mesmo por exemplo
        //'xyz','p1' tanto faz o nome o importarte vai ser o segundo call back do lado do mesmo q ser a varivel q ele vai ter o valor
        //so que la no view tenho q chamar o mesmo com $ na frente,por exemplo $xyz e $zzz
        return view('site.teste')->with('xyz', $p1)->with('zzz', $p2);
    }
}
