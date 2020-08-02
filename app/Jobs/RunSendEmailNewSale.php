<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class RunSendEmailNewSale implements ShouldQueue
{

    public $tries = 3;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(){ }

    public function handle()
    {       
        
        Mail::send('emails.email-new-sale', [], function ($m) {

			$m->from('contato@rits.com', 'Rits Lanchonete');
			$m->to('renatosistemas.vc@gmail.com', 'administrador')->subject('Novo Pedido');
		});
        
    }
    
   

}
