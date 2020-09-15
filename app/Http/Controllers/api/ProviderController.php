<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Provider;

class ProviderController extends Controller
{

    public function index()
    {
        $providers = Provider::all();
        $providersCount = $providers->count();

        if ($providersCount > 0) {
            return response()->json($providers);
        } else {
            return response()->json([
                'message' => 'Não existem fornecedores cadastrados.'
            ]);
        }

    }


    public function store(Request $request)
    {

        $provider = $request->all();

        if (!empty($provider)) {
            Provider::create($request->all());
            return response()->json([
                'message' => 'Fornecedor cadastrado com sucesso.'
            ]);
        } else {
            return response()->json([
                'message' => 'Verifique os campos antes de cadastrar um fornecedor.'
            ]);
        }
    }


    public function show($id)
    {
        $provider = Provider::find($id);

        if (!empty($provider)) {
            return response()->json($provider);
        } else {
            return response()->json([
                'message' => 'Fornecedor não encontrado.'
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $provider = Provider::find($id);

        if (!empty($provider)) {
            $provider->update($request->all());
            return response()->json([
                'message' => 'Fornecedor atualizado com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Fornecedor não encontrado.'
            ]);
        }

    }


    public function destroy($id)
    {
        $provider = Provider::find($id);

        if (!empty($provider)) {
            $provider->delete();
            return response()->json([
                'message' => 'Fornecedor excluído com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Fornecedor não encontrado.'
            ]);
        }
    }
}
