<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Services\UserService;
use Exception;

class ClientService
{

	public function __construct(UserService $userService){

		$this->userService = $userService;
	}

	public function getAllPaginate($filtro = []){

        $res = Client::where(function ($query) use (&$filtro) {
			
			if(isset($filtro['name']) && !empty($filtro['name']))
				$query->where('name', 'ilike', "%" . $filtro['name'] . "%");

		})->orderBy('id','desc')->paginate(20);

        return $res;
	}
	
	public function getAll(){

        $res = Client::get();
        return $res;        
    }
	
	public function getById($id){

        $res = Client::find($id);
        return $res;       
    }

	public function store($array){

		DB::beginTransaction();

        try {
		
			$client = Client::create([

				'name' => $array['name'],
				'email' => $array['email'],
				'phone' => $array['phone'],
				'andress' => $array['andress']
			]);

			$resUser = $this->userService->store([

				'name' => $array['name'],
				'email' => $array['email'],
				'password' => $array['password'],
				'client_id' => $client->id
			]);

			if(isset($resUser['erro'])){
    
				DB::rollback();
				return $resUser;
			}

			DB::commit();
            return $resUser;

		}catch (\Exception $e) {
			DB::rollback();
			throw new Exception($e->getMessage());
		}
    }

	public function update($array, $id){
		
		$res = Client::find($id);
		return $res->update($array);       
    }

	public function delete($id){
           
		$res = Client::find($id);
		return $res->delete();        
    }

}
