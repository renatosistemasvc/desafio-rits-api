<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(UserService $userService){

        $this->userService = $userService;
    }

    public function getUserLogged(){
        
        $id = Auth::guard('api')->user()->id;
        
        $res = $this->userService->getById($id);
        return response()->json($res);
    }
    
    public function store(Request $request){

        $array =  $request->all();

        $res = $this->userService->store($array);
        return response()->json($res);    
    }

    public function loginClient(Request $request){

        $array =  $request->all();

        $res = $this->userService->loginClient($array);
        return response()->json($res);    
    }
    
}
