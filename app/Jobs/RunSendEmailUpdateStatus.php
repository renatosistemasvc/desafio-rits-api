<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class RunSendEmailUpdateStatus implements ShouldQueue
{

    public $tries = 3;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $client_email;
    private $client_name;
    private $status;

    public function __construct($client_email, $client_name, $status){

        $this->client_email = $client_email;
        $this->client_name = $client_name;
        $this->status = $status;
    }

    public function handle()
    {       
        
        Mail::send('emails.email-update-status', ['status' => $this->status], function ($m) {

			$m->from('contato@rits.com', 'Rits Lanchonete');
			$m->to($this->client_email, $this->client_name)->subject('Alteração de Status');
		});
        
    }
    
   

}
