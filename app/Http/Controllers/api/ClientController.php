<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{

    public function index()
    {
        $client = Client::all();
        $clientCount = $client->count();

        if ($clientCount > 0) {
            return response()->json($client);
        } else {
            return response()->json([
                'message' => 'Não existem clientes cadastrados.'
            ]);
        }
    }


    public function store(Request $request)
    {
        $client = $request->all();

        if (!empty($client)) {
            Client::create($request->all());
            return response()->json([
                'message' => 'Cliente cadastrado com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Verifique os campos antes de cadastrar um cliente.'
            ]);
        }

    }


    public function show($id)
    {

        $client = Client::find($id);

        if (!empty($client)) {
            return response()->json($client);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado.'
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!empty($client)) {
            $client->update($request->all());
            return response()->json([
                'message' => 'Cliente atualizado com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado.'
            ]);
        }
    }


    public function destroy($id)
    {
        $client = Client::find($id);

        if (!empty($client)) {
            $client->delete();
            return response()->json([
                'message' => 'Cliente excluído com sucesso!'
            ]);
        } else {
            return response()->json([
                'message' => 'Cliente não encontrado.'
            ]);
        }
    }
}
