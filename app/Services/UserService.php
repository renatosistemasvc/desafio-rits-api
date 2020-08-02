<?php

namespace App\Services;

use App\Services\LogService;
use Illuminate\Support\Facades\Hash;

use App\Models\Unidade;
use Illuminate\Support\Facades\DB;
use App\User;
use Exception;
use Auth;

class UserService
{

	public function store($array){

		DB::beginTransaction();

         try {

			$t = $this->checkUserExist($array['email']);
			 
			if($t){

				DB::rollback();
				return [ 'erro' => 'O e-mail informado já está cadastrado.'];
			}

			$array['password'] = bcrypt($array['password']);
			$array['type'] = 2;
			
			$user = User::create($array);
						
			$user['token'] = $user->createToken('rits')->accessToken;

			DB::commit();
            return $user; 
		
		} catch (\Exception $e) {
			DB::rollback();
			throw new Exception($e->getMessage());
		}
    }

	public function getById($id){

		$res = User::find($id);

		return $res;       
	}

	public function loginClient($dados){

		if(!isset($dados['email']) || empty($dados['email']) || !isset($dados['password']) || empty($dados['password']))
			return ['erro' => 'Preencha todos os campos.'];

		$user = User::where("email", $dados['email'])->first();

		if(empty($user) || $user['type'] != 2)
			return ['erro' => 'Usuário não localizado.'];
		
		if(!Hash::check($dados['password'], $user->password)) {
		
			return ['erro' => 'Usuário não autorizado.'];
		
		}else{
			
			$token = $user->createToken('rits')->accessToken;
		}

		return ['token' => $token];
	}

	private function checkUserExist($user){

		$res = User::where('email', $user)->exists();
		return $res;
	}
	
		   

}
