<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ClientService;
use Validator;

class ClientController extends Controller
{

    public function __construct(ClientService $clientService){

        $this->clientService = $clientService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->clientService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(Request $request){

        $filtro =  $request->all();

        $res = $this->clientService->getAll($filtro);
        return response()->json($res);
    }

    public function store(Request $request){

        $this->validate($request,         
            [ 
                'andress' => 'required',
                'email' => 'required|email|unique:clients',
                'name' => 'required',
                'password' => 'required',
                'phone' => 'required|unique:clients'
            ],
            [ 
                'required' => 'Preencha todos os campos obrigatórios (*).',
                'email.email' => 'O e-mail informado não é um e-mail válido.',
                'email.unique' => 'Já existe um cliente cadastrado com o e-mail informado.',
                'phone.unique' => 'Já existe um cliente com o telefone cadastrado.'
            ]
        );

        $array =  $request->all();

        $res = $this->clientService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->clientService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $array =  $request->all();

        $res = $this->clientService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->clientService->delete($id);
        return response()->json($res);
    }

}
