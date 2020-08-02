<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SaleService;

class SaleController extends Controller
{

    public function __construct(SaleService $saleService){

        $this->saleService = $saleService;
    }

    public function getAllPaginate(Request $request, $qtd = 10){

        $filtro = $request->all();

        $res = $this->saleService->getAllPaginate($filtro, $qtd);
        return response()->json($res);
    }

    public function cancelSale($id){

        $res = $this->saleService->cancelSale($id);
        return response()->json($res);
    }

    public function store(Request $request){

        $this->validate($request, 
        
            [ 'itens' => 'required'],
            [ 'required' => 'O campo: :attribute é um campo obrigatório.' ]
        );

        $array =  $request->all();

        $res = $this->saleService->store($array);
        return response()->json($res);
    }

    public function updateStatus(Request $request){

        $this->validate($request, 
        
            [ 
                'sale_id' => 'required',
                'status' => 'required'
            ],
            [ 'required' => 'Preencha todos os campos obrigatórios (*).' ]
        );

        $array =  $request->all();

        $res = $this->saleService->updateStatus($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->saleService->getById($id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->saleService->delete($id);
        return response()->json($res);
    }

}
