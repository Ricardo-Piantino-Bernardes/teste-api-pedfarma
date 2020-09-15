<?php

namespace App\Http\Controllers\api;


use App\Client;
use App\Http\Controllers\Controller;
use App\Product;
use App\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{

    public function index()
    {
        $sale = Sale::all();
        $saleCount = $sale->count();

        if ($saleCount > 0) {
            return response()->json($sale);
        } else {
            return response()->json([
                'message' => 'Não existem vendas cadastradas.'
            ]);
        }
    }


    public function store(Request $request)
    {
        $statusProduct = Product::where('id', $request['id_product'])->first();
        $client = Client::where('id', $request['id_client'])->first();

        if (!empty($statusProduct && $client)) {
            if ($statusProduct->status == 0) {
                return response()->json([
                    'message' => 'Produto indiponível para venda.'
                ]);
            }

            Sale::create($request->all());
        } else {
            return response()->json([
                'message' => 'Produto ou Cliente não encontrado.'
            ]);
        }

        return response()->json([
            'message' => 'Venda realizada com sucesso!'
        ]);
    }


    public function show($id)
    {
        $sale = Sale::find($id);

        if (!empty($sale)) {
            return response()->json($sale);
        } else {
            return response()->json([
                'message' => 'Venda não encontrada!',
            ]);
        }

    }


    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
        $saleProduct = Product::where('id', $request['id_product'])->first();
        $saleClient = Client::where('id', $request['id_client'])->first();

        if (!empty($saleProduct && $saleClient)) {
            $sale->update($request->all());
            return response()->json([
                'message' => 'Venda alterada com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Venda não encontrada!',
            ]);
        }
    }


    public function destroy($id)
    {
        $sale = Sale::find($id);

        if ($sale) {
            $sale->delete();

            return response()->json([
                'message' => 'Venda excluída com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Venda não encontrada!',
            ]);
        }
    }
}
