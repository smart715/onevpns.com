<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Module\CreateDroplet;
use App\Module\SshConnect;
use App\ServerListModel;
use Illuminate\Support\Facades\Log;


class FirstServer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $country_id;
    public $timeout = 0;
    public $tries = 1;

    public function __construct($country_id)
    {
        $this->country_id  = $country_id;
    }

    public function handle()
    {

        Log::info("TestTwo: item #");
        // ini_set('max_execution_time', 300)
        //$droplet = new CreateDroplet();
        //$server = $droplet->droplet($this->country_id,'testabcc');
        //$ssh = new SshConnect();
        //$ssh->ssh_proccess_paid($server->ip); //kontrülü yap
        //$ssh->ssh_add_paid_multiple($server->ip); //kontrülü yap
        //$ssh->ssh_disconnet($server->ip); //kontrolü yap

        //$server = ServerListModel::where('ip',$server->ip)->first();
        //$server->status = 1;
        //$server->save();
    }
}


