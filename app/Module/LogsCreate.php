<?php

namespace App\Module;

use App\LogsModel;
use Illuminate\Support\Facades\Log;
use App\SettingsVpn;

/**
 * Log Process
 */
class LogsCreate
{
    public function create($process_name,$process_descp,$status,$process){
//log sistemi status sitede görünecek mi görülmeyecek mi
        // 2 - 5 kadar önem
        // 9  ise failed ve hata demek mail attır
        //


        if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
            $userIp = $_SERVER['REMOTE_ADDR'];
        }else{
            $userIp = 'CronJob';
        }


        $log = new LogsModel();
        $log->process_name = $process_name;
        $log->process_descp = $process_descp;
        $log->status       = $status;
        $log->process = $process;
        $log->ip = $userIp;
        $log->save();

    }
    

}