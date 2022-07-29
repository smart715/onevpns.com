<?php

namespace App\Http\Controllers;

use App\Jobs\FirstServer;
use App\Jobs\ServerAski;
use App\Jobs\AddUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Module\CreateDroplet;
use App\Module\SshConnect;
use App\TokenListModel;
use App\ServerListModel;
use App\CountryModel;
use App\UserListModel;
use App\LogsModel;
use App\SettingModel;
use App\SettingsVpn;
use App\User;
use App\Module\LogsCreate;

class UsersController extends Controller
{

    public function index(Request $request){

        

        $token = $request->header('Auth');
        $user = User::where('api_token',$token)->first();

        if (!$user){
            $api['result'] = 'failure';
            $api['response'] = 'connection error';
            return response()->json($api, 200);
        }



        $setting = SettingsVpn::first();
        $user_status_aviable = UserListModel::where('country_id',$request->regionid)->where('status',1)->count();
        $users = UserListModel::where('country_id',$request->regionid)->count();
        $totalusing = number_format($user_status_aviable*100/$users);

        if (($setting->cronjob == 1) && ($setting->cronjob_status == 0)){
           if ($totalusing > $setting->total){

               $setting->cronjob_status = 1;
               $setting->save();
               dispatch(new AddUser($request->regionid));
           }
        }
        $country_paid = CountryModel::where('id',$request->regionid)->first();
        $user_uuid= UserListModel::where('country_id',$request->regionid)->where('uuid',$request->uuid)->first();

        if ($user_uuid){
            $users = UserListModel::join('server_list','user_list.server_id','=','server_list.id')
                ->where('user_list.id',$user_uuid->id)
                ->select('server_list.ip as ip','user_list.id as user_id','user_list.username as username','user_list.password as password','user_list.secretid as secretid','user_list.created_at as created_at')
                ->first();

            $api['result'] = 'success';
            $api['response'] = $users;
            return response()->json($api, 200);
        }
        else{
            if ($setting->alternative_server == 1){
                $server_main_capasity = ServerListModel::where('county_id',$request->regionid)->whereNull('ust_server_id')->first();
                $usercount = UserListModel::where('server_id',$server_main_capasity->id)->count();
                $usercount_k = UserListModel::where('server_id',$server_main_capasity->id)->where('status',1)->count();

                $sum = number_format($usercount_k *100/$usercount);
                if ($sum > $setting->server_cap){

                    $server_sub_control = ServerListModel::where('county_id',$request->regionid)->whereNotNull('ust_server_id')->count();
                    if ($server_sub_control > 0){

                        $users = UserListModel::join('server_list','user_list.server_id','=','server_list.id')
                            ->where('user_list.country_id',$request->regionid)
                            ->where('user_list.status',0)
                            ->whereNotNull('server_list.ust_server_id')
                            ->where('user_list.paid',$country_paid->type_data)
                            ->select('server_list.ip as ip','user_list.id as user_id','user_list.username as username','user_list.password as password','user_list.secretid as secretid','user_list.created_at as created_at')
                            ->first();

                        $api['result'] = 'success';
                        $api['response'] = $users;


                        $user = UserListModel::where('id',$users->user_id)->first();
                        $user->status = 1;
                        $user->uuid = $request->uuid;
                        $user->save();
                        return response()->json($api, 200);
                    }
                }
            }
            $users = UserListModel::join('server_list','user_list.server_id','=','server_list.id')
                ->where('user_list.country_id',$request->regionid)
                ->where('user_list.status',0)
                ->whereNull('server_list.ust_server_id')
                ->where('user_list.paid',$country_paid->type_data)
                ->select('server_list.ip as ip','user_list.id as user_id','user_list.username as username','user_list.password as password','user_list.secretid as secretid','user_list.created_at as created_at')
                ->first();

            $api['result'] = 'success';
            $api['response'] = $users;

            $user = UserListModel::where('id',$users->user_id)->first();
            $user->status = 1;
            $user->uuid = $request->uuid;
            $user->save();
            return response()->json($api, 200);

        }
    }
    public function setting(Request $request){
        $setting = new SettingModel();
        $setting->uuid = $request->uuid;
        $setting->onesignalId = $request->onesignalId;
        $setting->premiumStatus = $request->premiumStatus;
        $setting->firebaseId = $request->firebaseId;
        $setting->save();

        $api['result'] = 'success';
        $api['response'] = $setting;
    }

}
