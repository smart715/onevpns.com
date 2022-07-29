<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module\SshConnect;
use App\User;

class TrafficController extends Controller
{



    public function index(Request $request){


        $ip = $request->ip;
        $username = $request->username;

        $ssh = new SshConnect();
        $ssh->ssh_traffic($ip,$username);

        $data = $ssh->ssh_traffic($ip,$username);


        $api['result'] = 'success';
        $api['response'] = $data;


        return response()->json($api, 200);
    }

}
