<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;


class ProductController extends Controller
{

    public function __construct(ProductService $productService){

        $this->productService = $productService;
    }

    public function getAllPaginate(Request $request){

        $filtro =  $request->all();

        $res = $this->productService->getAllPaginate($filtro);
        return response()->json($res);
    }

    public function getAll(Request $request){

        $filtro =  $request->all();

        $res = $this->productService->getAll($filtro);
        return response()->json($res);
    }

    public function store(Request $request){

        $this->validate($request,         
            [ 
                'name' => 'required',
                'price' => 'required'
            ],
            [ 
                'required' => 'Preencha todos os campos obrigatórios (*).'
            ]
        );

        $array =  $request->all();

        $res = $this->productService->store($array);
        return response()->json($res);
    }

    public function getById($id){

        $res = $this->productService->getById($id);
        return response()->json($res);
    }

    public function update(Request $request, $id){

        $this->validate($request,         
            [ 
                'name' => 'required',
                'price' => 'required'
            ],
            [ 
                'required' => 'Preencha todos os campos obrigatórios (*).'
            ]
        );

        $array =  $request->all();

        $res = $this->productService->update($array, $id);
        return response()->json($res);
    }

    public function delete($id){

        $res = $this->productService->delete($id);
        return response()->json($res);
    }

}
