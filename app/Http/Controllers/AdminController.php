<?php

namespace App\Http\Controllers;

use App\Jobs\FirstServer;
use App\Jobs\ServerAski;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Module\CreateDroplet;
use App\Module\SshConnect;
use App\Module\LogsCreate;
use App\TokenListModel;
use App\ServerListModel;
use App\CountryModel;
use App\UserListModel;
use App\LogsModel;
use App\SettingModel;
use App\SettingsVpn;
use App\User;
use App\Module\AddUser;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Redirect;
use DB;
use Alert;
use App\DigitalModel;
use App\test;

use Exception;

class AdminController extends Controller
{


    public function index(){
        if ($user = Sentinel::check())
        {
            $yearArrayFree = array();
            $yearArrayPaid = array();
            $yearArrayFreeColor = array();
            $yearArrayPaidColor = array();
            $yearArrayFreeName = array();
            $yearArrayPaidName = array();
            $freeCountry = array();
            $paidCountry = array();
            $yearTotalFree = 0;
            $yearTotalPaid = 0;


            $usercount = User::count();
            $usercount = $usercount -1;
            $multiuser = UserListModel::count();
            $servers = ServerListModel::get();

            $FreeUsersDay = UserListModel::join('country_list','user_list.country_id','country_list.id')
                                        ->select('country_list.type_data as paidcontrol','country_list.id as countid','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"))
                                        ->where('user_list.updated_at', '>', Carbon::now()->subDays(1))
                                        ->where('user_list.status',1)
                                        ->where('country_list.type_data',0)
                                        ->groupBy('country_list.id')
                                        ->get();



            $paidUsersDay = UserListModel::join('country_list','user_list.country_id','country_list.id')
                ->select('country_list.type_data as paidcontrol','country_list.id as countid','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"))
                ->where('user_list.updated_at', '>', Carbon::now()->subDays(1))
                ->where('user_list.status',1)
                ->where('country_list.type_data',1)
                ->groupBy('country_list.id')
                ->get();


            $colors = array('#f37070','#cfcfcf','#ff8f3a','#ffde16','#24cf91','#4ecc48','#5797fc','#33d4ff','#cfcfcf','#ff8f3a','#ffde16','#24cf91','#4ecc48','#ffde16','#24cf91','#4ecc48','#5797fc','#33d4ff','#cfcfcf','#ff8f3a','#ffde16','#24cf91','#4ecc48','#ffde16','#24cf91','#4ecc48','#5797fc','#33d4ff','#cfcfcf','#ff8f3a','#ffde16','#24cf91','#4ecc48');

            $i = 0;
            $freeCountry['sumUsers'] = 0;
            $paidCountry['sumUsers'] = 0;
            if (count($FreeUsersDay) > 0){
                foreach ($FreeUsersDay as $FreeUserDay){
                    $freeCountry['labels'][$i] = $FreeUserDay->country;
                    $freeCountry['sumUsers'] = $freeCountry['sumUsers'] + $FreeUserDay->totalcount;
                    $items['data'][$i] = $FreeUserDay->totalcount;
                    $items['backgroundColor'][$i] = $colors[$i];
                    $items['hoverBackgroundColor'][$i] = $colors[$i];
                    $i++;
                }
                $freeCountry['datasets'][] = $items;
            }
            $z = 0;
            if (count($paidUsersDay) > 0){
                foreach ($paidUsersDay as $paidUserDay){
                    $paidCountry['labels'][$z] = $paidUserDay->country;
                    $paidCountry['sumUsers'] = $freeCountry['sumUsers'] + $paidUserDay->totalcount;
                    $items1['data'][$z] = $paidUserDay->totalcount;
                    $items1['backgroundColor'][$z] = $colors[$z];
                    $items1['hoverBackgroundColor'][$z] = $colors[$z];
                    $z++;
                }
                $paidCountry['datasets'][] = $items1;
            }

            $userPerMonth= array();
            $userPerMonth['label'] = 'Leads';
            $userPerMonth['backgroundColor'] = '#ff445d';
            $userPerMonth['borderColor'] = '#ff445d';
            $userPerMonth['hoverBorderColor'] = '#ff445d';
            $userPerMonth['borderWidth'] = 0;

            for ($c=1; $c<=12; $c++){
                $age= 12 - $c;
                $userPerMonth['data'][]= count(UserListModel::whereNotIn('id', [1])->whereMonth('updated_at', '=', date('n') -$age)->where('status',1)->get());
            }

            $capHighs = UserListModel::join('country_list','user_list.country_id','country_list.id')
                ->join('server_list','user_list.server_id','server_list.id')
                ->select('server_list.id as serverid','server_list.ip as ip','server_list.server_company','server_list.ust_server_id as ustserverid','country_list.id as countid','country_list.status as countstatus','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"), DB::raw('COALESCE(SUM(user_list.status), 1) AS status_sum'))
                ->whereNull('ust_server_id')
                ->orderBy('status_sum','desc')
                ->take('5')
                ->groupBy('server_list.id')
                ->with('children', 'parent')
                ->get();


            $FreeUsersYear = UserListModel::join('country_list','user_list.country_id','country_list.id')
                ->select('country_list.type_data as paidcontrol','country_list.id as countid','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"))
                ->where('user_list.updated_at', '>', Carbon::now()->subDays(365))
                ->where('user_list.status',1)
                ->where('country_list.type_data',0)
                ->groupBy('country_list.id')
                ->get();

            $paidUsersYear = UserListModel::join('country_list','user_list.country_id','country_list.id')
                ->select('country_list.type_data as paidcontrol','country_list.id as countid','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"))
                ->where('user_list.updated_at', '>', Carbon::now()->subDays(365))
                ->where('user_list.status',1)
                ->where('country_list.type_data',1)
                ->groupBy('country_list.id')
                ->get();



            if (count($FreeUsersYear) > 0){
                $q = 0;
                foreach ($FreeUsersYear as $FreeUserYear){
                    $yearArrayFree[] = $FreeUserYear->totalcount;
                    $yearTotalFree = $yearTotalFree + $FreeUserYear->totalcount;
                    $yearArrayFreeName[] = $FreeUserYear->country;
                    $yearArrayFreeColor[] = $colors[$q];

                 $q++;
                }
            }

            if (count($paidUsersYear) > 0){
                $w = 0;
                foreach ($paidUsersYear as $paidUserYear){
                    $yearArrayPaid[] = $paidUserYear->totalcount;
                    $yearTotalPaid = $yearTotalPaid + $paidUserYear->totalcount;
                    $yearArrayPaidName[] = $paidUserYear->country;
                    $yearArrayPaidColor[] = $colors[$w];
                $w++;
                }
            }



            return view('crm_admin',compact('yearTotalFree','yearTotalPaid','yearArrayFreeName','yearArrayPaidName','yearArrayFreeColor','yearArrayPaidColor','usercount','multiuser','servers','paidCountry','freeCountry','userPerMonth','capHighs','yearArrayFree','yearArrayPaid'));
        }
        else
        {
            return Redirect::to('/admin');
        }
    }

    public function serverView(){
        if ($user = Sentinel::check())
        {
            $datas = UserListModel::join('country_list','user_list.country_id','country_list.id')
                ->join('server_list','user_list.server_id','server_list.id')
                ->select('server_list.id as serverid','server_list.ip as ip','server_list.server_company','server_list.ust_server_id as ustserverid','country_list.id as countid','country_list.status as countstatus','country_list.country as country','country_list.city as city','country_list.type as type',DB::raw("count(user_list.id) AS totalcount"), DB::raw('COALESCE(SUM(user_list.status), 1) AS status_sum'))
                ->whereNull('ust_server_id')
                ->groupBy('server_list.id')
                ->orderBy('server_list.paid', 'ASC')
                ->with('children', 'parent')
                ->get();

            return view('crm_admin_server',compact('datas'));
        }
        else
        {
            return Redirect::to('/admin');
        }
    }

    public function login(){

        $log = new LogsCreate();
        if ($user = Sentinel::check())
        {
            return Redirect::to('/admin/dashboard');
        }
        else
        {
            $log->create('Login','Dont Login','1','0');
            return view('login');
        }
    }

    public function login_post(Request $request){
        $credentials = [
            'email'    => 'info@onevpns.com',
            'password' => $request->password,
        ];

        Sentinel::authenticateAndRemember($credentials);

        return Redirect::to('/admin/dashboard');

    }

    public function register(){

        $credentials = [
            'email'    => 'info@onevpns.com',
            'password' => '123Roshan',
        ];

        $user = Sentinel::registerAndActivate($credentials);

        print_r($user);
        exit();

    }

    public function adduser($countryid,$usercount){
        $log = new LogsCreate();
        if ($user = Sentinel::check())
        {

            try {
                $log->create('Adduser','Country id:'.$countryid.' Add User:'.$usercount,'1','1');
                $server = ServerListModel::where('county_id',$countryid)->first();

                $ssh = new SshConnect();
                if($server->sshuser =='root'){
                    $ssh->ssh_add_paid_multiple($server->ip,$usercount);
                }else{
                    $ssh->google_ssh_add_paid_multiple($server->ip,$usercount);
                }
                $ssh->ssh_disconnet($server->ip);
                $log->create('Adduser','Country id:'.$countryid.' Add User:'.$usercount.' Finish','1','1');
                return Redirect::to('/admin/');

            }
            catch (\Exception $ex) {
                $log->create('Adduser','Country id:'.$countryid.' Ex:'.$ex,'1','0');
                return Redirect::to('/admin/serverview');

            }

        }
        else
        {
            return view('login');
        }


    }

    public function resetuser($countryid){
        $log = new LogsCreate();

        if ($user = Sentinel::check())
        {
            $log->create('Resetuser','Country id:'.$countryid.' Reset User','1','1');

            $server = ServerListModel::where('county_id',$countryid)->first();

            $ssh = new SshConnect();
            $ssh->ssh_reset($server->ip);
            $ssh->ssh_disconnet($server->ip);
            $log->create('Resetuser','Country id:'.$countryid.' Reset User Final','1','1');

            return Redirect::to('/admin/serverview');

        }
        else
        {
            return view('login');

        }
    }

    public function countryGet(){

        $digital = DigitalModel::first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.digitalocean.com/v2/regions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Authorization: Bearer ".$digital->token,
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: api.digitalocean.com",
                "Postman-Token: ce6f379f-a491-48e7-8af3-19611ad0fb3f,63007fcb-4c25-4e35-9ff0-9607457717cf",
                "User-Agent: PostmanRuntime/7.11.0",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);


        }
        $regions  = $response->regions;
        return view('country',compact('regions','digital'));
    }

    public function countryPost(Request $request){
        $log = new LogsCreate();

        ////Session::put('loading','Setup Settings Available');

        $country = new CountryModel();
        $country->regions   = $request->regions;
        $country->country   = $request->country;
        $country->city   = $request->city;
        $country->country_code   = $request->code;
        $country->status = 0;

        if ($request->serverpaid == 'free'){
            $country->type_data   = 0;
        }else{
            $country->type_data   = 1;
        }
        $country->type   = $request->serverpaid;


        $country->save();

        $log->create('newServer','Country id:'.$country->id.' Digitalocean New Server İnstall','1','1');

        // //Session::put('loading','DigitalOcean Server Create');


        $droplet = new CreateDroplet();
        $server = $droplet->droplet($country->id,'serverinstall',$country->type_data);
        $ssh = new SshConnect();

        $ssh->ssh_proccess_paid($server->ip);
        $ssh->ssh_add_paid_multiple($server->ip);
        $ssh->ssh_disconnet($server->ip);

        $country_status = CountryModel::where('id',$country->id)->first();
        $country_status->status = 1;
        $country_status->save();

        $server = ServerListModel::where('ip',$server->ip)->first();
        $server->status = 1;
        $server->server_company = 'Digitalocean';
        $server->save();

        return Redirect::to('/admin/serverview');

    }
    
    public function servermanuelGet(){

        return view('manuel');
    }

    public function manuel_server_install(Request $request){
        $country = new CountryModel();
        $country->regions   = $request->regions;
        $country->country   = $request->country;
        $country->city   = $request->city;
        $country->country_code   = $request->code;
        $country->status = 0;

        if ($request->serverpaid == 'free'){
            $country->type_data   = 0;
        }else{
            $country->type_data   = 1;
        }
        $country->type   = $request->serverpaid;
        $country->save();

        $server = new ServerListModel();
        $server->droplet_id = '1234567890';
        $server->county_id =$country->id;
        $server->ip = $request->ip;
        $server->status = 0;
        $server->paid = $country->type_data;
        $server->sshuser =$request->sshuser;
        $server->server_company = $request->company;
        $server->save();


        $ssh = new SshConnect();

        if ($request->company == 'Google'){

            $ssh->google_ssh_proccess_paid($server->ip);
            $ssh->google_ssh_add_paid_multiple($server->ip,100);
            $ssh->ssh_disconnet($server->ip);


        }else if ($request->company == 'Vultr'){
            $ssh->ssh_proccess_paid($server->ip);
            $ssh->ssh_add_paid_multiple($server->ip);
            $ssh->ssh_disconnet($server->ip);

        }else if ($request->company =='Amazon'){

            $ssh->google_ssh_proccess_paid($server->ip);
            $ssh->google_ssh_add_paid_multiple($server->ip);
            $ssh->ssh_disconnet($server->ip);


        }else{
            $ssh->ssh_proccess_paid($server->ip);
            $ssh->ssh_add_paid_multiple($server->ip);
            $ssh->ssh_disconnet($server->ip);
        }
        $log = new LogsCreate();
        $log->create('newServer','Country id:'.$country->id.' '.$request->company.' New Server İnstall','1','1');

        $country_status = CountryModel::where('id',$country->id)->first();
        $country_status->status = 1;
        $country_status->save();

        return Redirect::to('/admin/serverview');
        

    }

    public function changePaid($countryid,$type){
        ////Session::put('loading','Change Paid');

        if ($type == 'free'){
            $country = CountryModel::where('id',$countryid)->first();
            $server = ServerListModel::where('county_id',$countryid)->first();

                $country->type      = 'paid';
                $country->type_data = 1;
                $country->save();

                $server->paid = 1;
                $server->save();

            $users = UserListModel::where('country_id',$countryid)->get();

                foreach ($users as $user){
                    $user->paid = 1;
                    $user->save();
                }

        }else{

            $country = CountryModel::where('id',$countryid)->first();
            $server = ServerListModel::where('county_id',$countryid)->first();

            $country->type      = 'free';
            $country->type_data = 0;
            $country->save();

            $server->paid = 0;
            $server->save();

            $users = UserListModel::where('country_id',$countryid)->get();

            foreach ($users as $user){
                $user->paid = 0;
                $user->save();
            }
        }

        return Redirect::to('/admin/serverview');

    }

    public function deleteServer($countryid){
        $users = UserListModel::where('country_id',$countryid)->delete();
        $server = ServerListModel::where('county_id',$countryid)->delete();
        $country = CountryModel::where('id',$countryid)->delete();
        return Redirect::to('/admin/serverview');
    }

    public function serverEdit($countryid){



        $country = CountryModel::where('id',$countryid)->first();
        $ip = ServerListModel::where('county_id',$country->id)->first();
        $ip = $ip->ip;

        return view('edit',compact('country','ip'));
    }

    public function serverEditPost(Request $request){

        $log = new LogsCreate();
        $log->create('Resetuser','Country id:'.$request->countid.' Server Edit','1','1');

        $country = CountryModel::where('id',$request->countid)->first();
        $country->country = $request->country;
        $country->city = $request->city;
        $country->country_code = $request->country_code;
        $country->save();

        $ip_update = ServerListModel::where('county_id',$country->id)->first();
        $ip_update->ip = $request->ip;
        $ip_update->save();

        return Redirect::to('/admin/serverview');

    }

    public function hideshow($countryid,$status){

        $log = new LogsCreate();
        $log->create('HideShow','Country id:'.$countryid.'Hide Show','0','1');

        $country = CountryModel::where('id',$countryid)->first();

        if ($status == 1){
            $country->status = 0;
        }else{
            $country->status = 1;
        }

        $country->save();

        return Redirect::to('/admin/serverview');

    }

    public function token_digital(Request $request){
        $digital = DigitalModel::first();
        $digital->token = $request->token_digital;
        $digital->save();

        return Redirect::to('/admin/settings');
    }

    public function alternativeServer(){
        $setting = ServerListModel::first();

        if ($setting->alternative_server == 0){
            $setting->alternative_server = 1;
        }else{
            $setting->alternative_server = 0;
        }

        $setting->save();

        Alert::success('Activated');
        return Redirect::to('/admin/serverview');

    }

    public function manuel_alternative_get(){


        $servers = ServerListModel::join('country_list','server_list.county_id','=','country_list.id')
            ->select('country_list.country','country_list.city','country_list.type','country_list.status','server_list.ip','server_list.server_company','server_list.id as serverid')
            ->whereNull('server_list.ust_server_id')
            ->get();



        $digital = DigitalModel::first();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.digitalocean.com/v2/regions",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Authorization: Bearer ".$digital->token,
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: api.digitalocean.com",
                "Postman-Token: ce6f379f-a491-48e7-8af3-19611ad0fb3f,63007fcb-4c25-4e35-9ff0-9607457717cf",
                "User-Agent: PostmanRuntime/7.11.0",
                "accept-encoding: gzip, deflate",
                "cache-control: no-cache"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response);


        }
        $regions  = $response->regions;
        return view('alternative',compact('regions','servers'));


    }

    public function manuel_alternative_post(Request $request){


       $server_main = ServerListModel::where('id',$request->mainserver)->first();
       $country = CountryModel::where('id',$server_main->county_id)->first();


        if ($request->company == 'Digitalocean'){

            $droplet = new CreateDroplet();
            $server = $droplet->droplet($country->id,'serverinstall',$country->type_data);
            $ssh = new SshConnect();
            $ssh->ssh_proccess_paid($server->ip);
            $ssh->ssh_add_paid_multiple($server->ip);
            $ssh->ssh_disconnet($server->ip);


            $server = ServerListModel::where('ip',$server->ip)->first();
            $server->status = 0;
            $server->server_company = 'Digitalocean';
            $server->ust_server_id = $request->mainserver;
            $server->save();

        }else{

            $ssh = new SshConnect();

            $server = new ServerListModel();
            $server->droplet_id = '1234567890';
            $server->county_id =$country->id;
            $server->ip = $request->ip;
            $server->status = 0;
            $server->paid = $country->type_data;
            $server->sshuser =$request->sshuser;
            $server->server_company = $request->company;
            $server->ust_server_id = $request->mainserver;
            $server->save();

            if ($request->company == 'Google'){

                $ssh->google_ssh_proccess_paid($server->ip);
                $ssh->google_ssh_add_paid_multiple($server->ip,100);
                $ssh->ssh_disconnet($server->ip);


            }else if ($request->company == 'Vultr'){
                $ssh->ssh_proccess_paid($server->ip);
                $ssh->ssh_add_paid_multiple($server->ip);
                $ssh->ssh_disconnet($server->ip);

            }else if ($request->company =='Amazon'){

                $ssh->google_ssh_proccess_paid($server->ip);
                $ssh->google_ssh_add_paid_multiple($server->ip,100);
                $ssh->ssh_disconnet($server->ip);


            }else{
                $ssh->ssh_proccess_paid($server->ip);
                $ssh->ssh_add_paid_multiple($server->ip);
                $ssh->ssh_disconnet($server->ip);
            }

        }


        Alert::success('Sub Server Create');
        return Redirect::to('/admin/serverview');


    }

    public function deleteServersub($serverid){

        $server = ServerListModel::where('id',$serverid)->delete();
        $users = UserListModel::where('server_id',$serverid)->delete();
        Alert::success('Successful');
        return Redirect::to('/admin/dashboard');
    }

    public function resetusersub($serverid){
        if ($user = Sentinel::check())
        {
            $server = ServerListModel::where('id',$serverid)->first();

            $ssh = new SshConnect();
            $ssh->ssh_reset($server->ip);
            $ssh->ssh_disconnet($server->ip);

            return Redirect::to('/admin/dashboard');

        }
        else
        {
            return view('login');

        }
    }

    public function addusersub($serverid,$usercount){
        if ($user = Sentinel::check())
        {
            $server = ServerListModel::where('id',$serverid)->first();
            $ssh = new SshConnect();
            $ssh->google_ssh_add_paid_multiple($server->ip,$usercount);
            $ssh->ssh_disconnet($server->ip);

            return Redirect::to('/admin/dashboard');

        }
        else
        {
            return view('login');
        }

    }

    public function live_user(){
        header('Content-Type: application/json');
        $data = array();
        $servers = ServerListModel::where('sshuser','=','root')->get();
        foreach ($servers as $key => $server){
            $ssh = new SshConnect();
            $active_user = $ssh->ssh_live_user($server->ip);
            $ssh->ssh_disconnet($server->ip);

            $data['actives'][$key]= array('id' => $server->id,'ip' => $server->ip, 'activeuser' => $active_user);
        }

        return response()->json($data);


    }
    

    public function logsView(){
        $logs = LogsModel::orderBy('id','desc')->get();
        return view('logs',compact('logs'));
    }

    public function settingView(){
        $setting = SettingsVpn::first();
        $token = DigitalModel::first();
        return view('setting',compact('setting','token'));
    }

    public function settingPostcron(Request $request){
        $setting = SettingsVpn::first();
        $log = new LogsCreate();

        if ($request->islem == 'cron'){
            if ($request->switchCron == 'on'){
                $setting->cronjob = 1;
                $log->create('Cron','Cron Active','1','1');

            }else{
                $setting->cronjob = 0;
                $log->create('Cron','Cron Passive','1','1');
            }
            $setting->total = $request->total;
        }
            $setting->save();

        return Redirect::to('/admin/settings');

    }

    public function settingPostsub(Request $request){
        $setting = SettingsVpn::first();
        $log = new LogsCreate();

        if ($request->switchSub == 'on'){
                $setting->alternative_server = 1;
            $log->create('SubServer','SubServer Active','1','1');

        }else{
                $setting->alternative_server = 0;
            $log->create('SubServer','SubServer Passive','1','1');

        }
            $setting->server_cap = $request->server_cap;
        $setting->save();


        return Redirect::to('/admin/settings');

    }

    public function settingBundle(Request $request){
        $setting = SettingsVpn::first();
        $log = new LogsCreate();
        $setting->bundleid = $request->bundleid;
        $log->create('Bundle','Bundle ID Change','1','1');
        $setting->save();
        return Redirect::to('/admin/settings');

    }

    public function settingsVpn(){
        header('Content-Type: application/json');

        $setting = SettingsVpn::select('cronjob_status')->first();
        return response()->json($setting);
     

    }

    public function ipSecRestart($countryid){
        $server = ServerListModel::where('county_id',$countryid)->first();

        $ssh = new SshConnect();
        $ssh->ssh_ipsec($server->ip);
        $ssh->ssh_disconnet($server->ip);
        $log = new LogsCreate();
        $log->create('ipSec Restart','Country id:'.$countryid,'1','1');
        return Redirect::to('/admin/serverview');
    }

    public function cronReset(){
        $setting = SettingsVpn::first();
        $setting->cronjob_status = 0;
        $setting->save();

    

        return Redirect::to('/admin/settings');

    }

    public function testQeues(){

       //$jobs = test::query()->delete();
        echo '<pre>';
        $jobs = test::all();
        print_r($jobs);
    }

    public function ssh_ipsec_all(){
        $ssh = new SshConnect();
        $ssh->ssh_ipsec_all();
        return Redirect::to('/admin/serverview');

    }




}
