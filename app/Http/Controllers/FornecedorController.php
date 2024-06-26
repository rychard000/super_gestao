<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;
use PDO;

class FornecedorController extends Controller
{
    // public function index(){
    //     //criando um array e passando ele para minha view atraves do metod compact,basta somente
    //     //passar o nome da variavel sem o $
    //     $fornecedores = [
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //         'Fornecedor 1',
    //     ];

    //     $fornecedores2 = [
    //         0 => [
    //             'nome' => 'Fornecedor1',
    //             'status' => 'N',
    //             'cnpj' => '0',
    //             'cpf' => '000.000.000-00',
    //             'ddd' => '11', //Sao Paulo (SP)
    //             'telefone' => '0000-0000'
    //         ],
    //         1 => [
    //             'nome' => 'Fornecedor2',
    //             'status' => 'S',
    //             'cnpj' => null,
    //             'ddd' => '85', //Fortaleza (CE)
    //             'telefone' => '0000-0000'
    //         ],
    //         2 => [
    //             'nome' => 'Fornecedor3',
    //             'status' => 'S',
    //             'cnpj' => null,
    //             'ddd' => '32', //Juiz de Fora (MG)
    //             'telefone' => '0000-0000'
    //         ]
    //     ];

    //     return view('app.fornecedor.index', compact('fornecedores2'));
    // }

    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(Request $request){ 
        
        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')
        ->paginate(2);

        //apenas o parametros que foram encaminhados pelo formulario,entao ao clicar nas opcoes de visualizacao do paginate ele fica apenas
        //como os registros procurados por exemplo apenas os registros com 'uf' 'SP'
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){  

        $msg = '';

        //inclusao
        if($request->input('_token') != '' && $request->input('id') == ''){

            $validated = $request->validate(
                [
                    'nome' => 'required|min:3|max:40',
                    'site' => 'required', 
                    'uf' => 'required|min:2|max:2',
                    'email' => 'email'
                ],
                [
                    'required' => 'O campo :attribute deve ser preenchido',
                    'nome.min' => 'O campo nome deve ter no minimo 3 caracteres',
                    'nome.max' => 'O campo nome deve ter no maximo 30 caracteres',
                    'uf.min' => 'O campo uf deve ter no minimo 3 caracteres',
                    'uf.min' => 'O campo uf deve ter no minimo 30 caracteres',
                    'email.email' => 'O campo e-mail nao foi preenchido corretamente'
                ]
            );

            Fornecedor::create($validated);
            $msg = 'Cadastro realizado com sucesso !';
        }

        //edicao
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg = 'Atualizacao realizada com sucesso';
            }else{
                $msg = 'Erro ao tentar atualizar o registro!!';
            }

            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }

        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){
        echo $id;
        $fornecedor = Fornecedor::find($id);
        
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id){
        //se o sofDeletes estiver ativo no models fornecedor, ele ira colocar um data no deleted_at,para deletar definitivamente
        //tenho qque usar o metodo forceDelete 
        
        // Fornecedor::find($id)->delete();
        Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor.listar');
    }
}