<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Jobs\RunSendEmailUpdateStatus;
use App\Jobs\RunSendEmailNewSale;

use App\Models\Sale;
use App\Models\ItemSale;
use Exception;
use Auth;
use Helper;

class SaleService
{
	public function getAllPaginate($filtro, $qtd = 10){

		$query = Sale::with(['client', 'itensSale.product'])->orderBy('id','desc');

		if(isset($filtro['client_name']) && !empty($filtro['client_name'])){

			$query->whereHas('client', function($query) use ($filtro) {

				$query->where('name', $filtro['client_name']);
			});
		}

		if(isset($filtro['periodo'][0]) && !empty($filtro['periodo'][0]))
			$query->where('date', '>=',  $filtro['periodo'][0] . ' 00:00:00');

		if(isset($filtro['periodo'][1]) && !empty($filtro['periodo'][1]))
			$query->where('date', '<=',  $filtro['periodo'][1] . ' 23:59:59');

		if(isset($filtro['status']) && !empty($filtro['status']))
			$query->where('status', $filtro['status']);
				
		if(Auth::guard('api')->user()->type == 2)
			$query->where('client_id', Auth::guard('api')->user()->client->id);
		
		$res = $query->paginate($qtd);

        return $res;
	}
	
	public function getById($id){

        $res = Sale::find($id);
        return $res;       
    }

	public function store($array){

		DB::beginTransaction();

        try {
			
			$sale = Sale::create([
				'date' => date('Y-m-d H:i:s'),
				'status' => 1,
				'price_sale' => $array['total_sale'],
				'client_id' => Auth::guard('api')->user()->client->id
			]);

			$itens = [];
			foreach($array['itens'] as $val){

				$itens [] = new ItemSale([

					'quanty' => $val['quanty'],
					'price_subtotal' => $val['sub_total'],
					'product_id' => $val['produto_id']	
				]);
			}

			$sale->itensSale()->saveMany($itens);

			RunSendEmailNewSale::dispatch();

			DB::commit();
            return $sale;

		}catch (\Exception $e) {
			DB::rollback();
			throw new Exception($e->getMessage());
		}
    }

	public function cancelSale($id){
		
		$res = Sale::find($id);

		//SE O USUÁRIO LOGADO NÃO FOR ADMINISTRADOR E O PEDIDO NÃO PERTENCER AO USUÁRIO LOGADO, BLOQUEIA O CANCELAMENTO
		if(Auth::guard('api')->user()->type != 1 && $res['client_id'] != Auth::guard('api')->user()->client->id)
			return ['erro' => 'Você não tem autorização para cancelar este pedido.'];

		return $res->update(['status' => 5]);       
	}
	
	public function updateStatus($array){

		$sale = Sale::with(['client'])->find($array['sale_id']);
		
		//SE O USUÁRIO LOGADO NÃO FOR ADMINISTRADOR E O PEDIDO NÃO PERTENCER AO USUÁRIO LOGADO, BLOQUEIA O CANCELAMENTO
		if(Auth::guard('api')->user()->type != 1 && $sale['client_id'] != Auth::guard('api')->user()->client->id)
			return ['erro' => 'Você não tem autorização para alterar o status deste pedido.'];

		$res = $sale->update(['status' => $array['status']]);

		RunSendEmailUpdateStatus::dispatch($sale->client->email, $sale->client->name, Helper::getStatusPedido($array['status']));

		return $res;
	}
	
	public function delete($id){
           
		$sale = Sale::find($id);
		$sale->itensSale()->delete();
		$res = $sale->delete();

		return $res;      
    }

}
