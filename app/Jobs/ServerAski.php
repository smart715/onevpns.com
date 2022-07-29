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

class ServerAski implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $country_id;
    protected $status;
    public $tries = 1;
    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($country_id,$status)
    {
        $this->country_id  = $country_id;
        $this->status  = $status;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            $droplet = new CreateDroplet();
            $server = $droplet->droplet($this->country_id,'testabcc',$this->status);
            $ssh = new SshConnect();
            $ssh->ssh_proccess_paid($server->ip); //kontrülü yap
            $ssh->ssh_add_paid_multiple($server->ip); //kontrülü yap
            $ssh->ssh_disconnet($server->ip); //kontrolü yap

            $server = ServerListModel::where('ip',$server->ip)->first();
            $server->status = 1;
            $server->save();


    }
}
