<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Provider;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{

    public function index()
    {
        $product = Product::all();
        $productCount = $product->count();

        if ($productCount > 0) {
            return response()->json($product);
        } else {
            return response()->json([
                'message' => 'Não existem produtos cadastrados.'
            ]);
        }
    }


    public function store(Request $request)
    {
        $productProvider = Provider::where('id', $request['id_provider'])->first();

        if (!empty($productProvider)) {
            Product::create($request->all());
            return response()->json([
                'message' => 'Produto cadastrado com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Verifique se esse fornecedor está cadastrado.'
            ]);
        }

    }


    public function show($id)
    {
        $product = Product::find($id);

        if (!empty($product)) {
            return response()->json($product);
        } else {
            return response()->json([
                'message' => 'Produto não encontrado!',
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $productProvider = Provider::where('id', $request['id_provider'])->first();


        if (!empty($product && $productProvider)) {
            $product->update($request->all());
            return response()->json([
                'message' => 'Produto atualizado com sucesso!',
            ]);
        } else {
            return response()->json([
                'message' => 'Verifique os dados antes de atualizar!',
            ]);
        }
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'message' => 'Produto excluído com sucesso!'
            ]);
        }else{
            return response()->json([
                'message' => 'Produto não encontrado.'
            ]);
        }

    }

    public function ActiveProducts()
    {
        $product =  Product::where('status', '1')->get();
        $productCount = $product->count();

        if ($productCount > 0){
            return response()->json($product);
        }else{
            return response()->json([
                'message' => 'Nenhum produto ativo.'
            ]);
        }
    }

    public function InactiveProducts()
    {
        $product =  Product::where('status', '0')->get();
        $productCount = $product->count();

        if ($productCount > 0){
            return response()->json($product);
        }else{
            return response()->json([
                'message' => 'Nenhum produto inativo.'
            ]);
        }
    }
}
