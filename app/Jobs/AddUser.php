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
use App\Module\LogsCreate;
use App\SettingsVpn;


class AddUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $country_id;
    public $tries = 1;
    public $timeout = 0;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($country_id)
    {
        $this->country_id  = $country_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $log = new LogsCreate();
        

        $server = ServerListModel::where('county_id',$this->country_id)->first();

            $log->create('Cronjob','Country id:'.$this->country_id,'0','1');
            $ssh = new SshConnect();
            if ($server->sshuser =! 'root'){
                $ssh->google_ssh_add_paid_multiple($server->ip);

            }else{
                $ssh->ssh_add_paid_multiple($server->ip);
            }

            $setting = SettingsVpn::first();
            $setting->cronjob_status = 0;
            $setting->save();

            $ssh->ssh_disconnet($server->ip);

        

    }
}
