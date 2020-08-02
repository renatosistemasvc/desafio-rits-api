<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

	public function getAllPaginate($filtro = []){

        $res = Product::where(function ($query) use (&$filtro) {
			
			if(isset($filtro['name']) && !empty($filtro['name']))
				$query->where('name', 'ilike', "%" . $filtro['name'] . "%");

		})->orderBy('id','desc')->paginate(20);

        return $res;
	}
	
	public function getAll(){

        $res = Product::get();
        return $res;        
    }
	
	public function getById($id){

        $res = Product::find($id);
        return $res;       
    }

	public function store($array){
		
		$res = Product::create($array);
		return $res;
    }

	public function update($array, $id){
		
		$res = Product::find($id);
		return $res->update($array);       
    }

	public function delete($id){
           
		$res = Product::find($id);
		return $res->delete();        
    }

}
