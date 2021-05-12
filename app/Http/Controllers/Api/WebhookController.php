<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Webhook;

class WebhookController extends Controller
{

    public function store(Request $request){

        $filtro['content'] =  $request->all();

        Webhook::create(['content' => json_encode($filtro)]);

        return response()->json('success');
    }

}
