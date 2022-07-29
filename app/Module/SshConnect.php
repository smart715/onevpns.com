<?php

namespace App\Module;

use App\ServerListModel;
use App\UserListModel;
use App\CountryModel;
use App\User;
use App\Module\LogsCreate;
use phpseclib\Net\SSH2;
use phpseclib\Crypt\RSA;
use App\Logs;
use Exception;
use Carbon\Carbon;

/**
 * Digital Ocean api Process
 */
class SshConnect
{


    public function connect($ip)
    {
        // TODO Bağlanamazsa loga yazdır hide yap.

        try {

            $connect = ssh2_connect($ip, 22,
                array('hostkey'=>'ssh-rsa'));
            /*$connect = new SSH2($ip);*/
        }
        catch (\Exception $ex) {

            dd('ip and username wrong!! ssh dont connect server', $ex);
        }
        return $connect;
    }
    public function ssh_live_user($ip){
        $connect = $this->connect($ip);

        $server = ServerListModel::where('ip',$ip)->first();


        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'keys/id_rsa.pub','keys/id_rsa', '')) {
             $stream1  = ssh2_exec($connect, 'sudo docker exec -t ipsec-vpn-server ipsec whack --trafficstatus');
                sleep(0.5);
                stream_set_blocking($stream1, true);
                $stream_out = ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
                $parcala    =   stream_get_contents($stream_out);
                $lsbresult = explode("\n", $parcala);
                $server_active = count($lsbresult)-1;


                return $server_active;

        } else {
            echo 'baglanti başarısız..';
        }
    }
    public function google_ssh_proccess_paid($ip){
        $connect = $this->connect($ip);
        $server = ServerListModel::where('ip',$ip)->first();

        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'keys/id_rsa.pub','keys/id_rsa', '')) {
            //Session::put('loading','Performing Server Setup and Settings');


            ssh2_exec($connect, 'git clone https://github.com/mobilejazz/docker-ipsec-vpn-server.git');
            sleep(2);
            ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server/docker;'.'sudo apt-get update');
            sleep(100);

            ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server/docker;'.'sudo apt -y install docker.io');
            sleep(150);

            ssh2_exec($connect, 'cd /home/'.$server->sshuser.'/docker-ipsec-vpn-server;'.'sudo ./start.sh');
            sleep(200);

            $iossolved= 'sudo docker exec ipsec-vpn-server sed -i \'s/sha2-truncbug=yes/sha2-truncbug=no/g\' /etc/ipsec.conf';
            $iossolved1 = 'sudo docker exec ipsec-vpn-server ipsec restart';
            $iosdns1= 'docker exec ipsec-vpn-server sed -i \'s/modecfgdns1=8.8.8.8/modecfgdns1=1.1.1.1/g\' /etc/ipsec.conf';
            $iosdns2= 'docker exec ipsec-vpn-server sed -i \'s/modecfgdns2=8.8.4.4/modecfgdns2=1.0.0.1/g\' /etc/ipsec.conf';

            $stream5 = ssh2_exec($connect, 'cd /home/'.$server->sshuser.'/docker-ipsec-vpn-server;'.$iossolved);
            stream_set_blocking($stream5, true);
            stream_get_contents($stream5); // Wait for command to finish
            fclose($stream5);

            $stream7 = ssh2_exec($connect, 'cd /home/'.$server->sshuser.'/docker-ipsec-vpn-server;'.$iosdns1);
            stream_set_blocking($stream7, true);
            stream_get_contents($stream7);
            fclose($stream7);

            $stream8 = ssh2_exec($connect, 'cd /home/'.$server->sshuser.'/docker-ipsec-vpn-server;'.$iosdns2);
            stream_set_blocking($stream8, true);
            stream_get_contents($stream8);
            fclose($stream8);

            $stream6 = ssh2_exec($connect, 'cd /home/'.$server->sshuser.'/docker-ipsec-vpn-server;'.$iossolved1);
            sleep(15);



        } else {

            echo 'baglanti başarısız..';
        }

    }
    public function google_ssh_add_paid_multiple($ip,$usercount = 100){
        $connect = $this->connect($ip);
        $server = ServerListModel::where('ip',$ip)->first();

        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'/var/www/vhosts/onevpns.com/httpdocs/vpn/keys/id_rsa.pub','/var/www/vhosts/onevpns.com/httpdocs/vpn/keys/id_rsa', '')) {

            $server = ServerListModel::where('ip',$ip)->first();
            if ($server->paid == 0){
                for ($i = 0; $i<$usercount; $i++){

                    $user = 'uuser'.$i.time();
                    $stream1 = '';
                    if ($server->sshuser != 'root'){//hasan_alper olanları bu yap
                        $stream1  = ssh2_exec($connect, 'sudo docker exec -t ipsec-vpn-server /adduser.sh '.$user);
                    }else{
                        $stream1    = ssh2_exec($connect, 'docker exec -t ipsec-vpn-server /adduser.sh '.$user);
                    }

                    sleep(1);
                    stream_set_blocking($stream1, true);
                    $stream_out = ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
                    $parcala    =   stream_get_contents($stream_out);
                    $parcala    = explode("Password", $parcala);

                    $user_add = new UserListModel();
                    $user_add->server_id = $server->id;
                    $user_add->country_id = $server->county_id;
                    $user_add->username = $user;
                    $z = 0 ;
                    foreach ($parcala as  $value) {
                        $bol = explode(':', $value);
                        if ($z == 0){
                            $user_add->secretid = trim($bol[1]);
                        }else{
                            $user_add->password = trim($bol[1]);
                        }
                        $z++;
                    }
                    $user_add->status = 0;
                    $user_add->paid = 0;
                    $user_add->save();
                }

            }
            else if ($server->paid == 1){

                for ($i = 0; $i<$usercount; $i++){
                    $user = 'uuser'.$i.time();
                    if ($server->sshuser != 'root'){//hasan_alper olanları bu yap
                        $stream1  = ssh2_exec($connect, 'sudo docker exec -t ipsec-vpn-server /adduser.sh '.$user);
                    }else{
                        $stream1    = ssh2_exec($connect, 'docker exec -t ipsec-vpn-server /adduser.sh '.$user);
                    }
                    sleep(1);
                    stream_set_blocking($stream1, true);
                    $stream_out = ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
                    $parcala    =   stream_get_contents($stream_out);
                    $parcala    = explode("Password", $parcala);

                    $user_add = new UserListModel();
                    $user_add->server_id = $server->id;
                    $user_add->country_id = $server->county_id;
                    $user_add->username = $user;

                    $z = 0 ;
                    foreach ($parcala as  $value) {
                        $bol = explode(':', $value);
                        if ($z == 0){
                            $user_add->secretid = trim($bol[1]);
                        }else{
                            $user_add->password = trim($bol[1]);
                        }
                        $z++;
                    }
                    $user_add->status = 0;
                    $user_add->paid = 1;
                    $user_add->save();
                }
            }
        } else {
            echo 'baglanti başarısız..';
        }
    }
    public function ssh_proccess_paid($ip){
        $connect = $this->connect($ip);
        $server = ServerListModel::where('ip',$ip)->first();
        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'keys/id_rsa.pub','keys/id_rsa', '')) {
            // Session::put('loading','Performing Server Setup and Settings');

            $stream1 = ssh2_exec($connect, '(git clone https://github.com/mobilejazz/docker-ipsec-vpn-server.git) && echo "Done"');
            $errorStream = ssh2_fetch_stream($stream1, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream, true);
            stream_set_blocking($stream1, true);
            $output = stream_get_contents($stream1);
            fclose($stream1);
            fclose($errorStream);



            $stream2 =  ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server/docker;'.'apt-get update');
            $errorStream2 = ssh2_fetch_stream($stream2, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream2, true);
            stream_set_blocking($stream2, true);
            $output = stream_get_contents($stream2);
            fclose($stream2);
            fclose($errorStream2);

            $stream3 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server/docker;'.'apt -y install docker.io');
            $errorStream3 = ssh2_fetch_stream($stream3, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream3, true);
            stream_set_blocking($stream3, true);
            $output = stream_get_contents($stream3);
            fclose($stream3);
            fclose($errorStream3);


            $stream4 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.'./start.sh');
            $errorStream4 = ssh2_fetch_stream($stream4, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream4, true);
            stream_set_blocking($stream4, true);
            $output = stream_get_contents($stream4);
            fclose($stream4);
            fclose($errorStream4);

            sleep(2);

            $iossolved= 'docker exec ipsec-vpn-server sed -i \'s/sha2-truncbug=yes/sha2-truncbug=no/g\' /etc/ipsec.conf';
            $iosdns1= 'docker exec ipsec-vpn-server sed -i \'s/modecfgdns1=8.8.8.8/modecfgdns1=1.1.1.1/g\' /etc/ipsec.conf';
            $iosdns2= 'docker exec ipsec-vpn-server sed -i \'s/modecfgdns2=8.8.4.4/modecfgdns2=1.0.0.1/g\' /etc/ipsec.conf';
            $iossolved1 = 'docker exec ipsec-vpn-server ipsec restart';

            $stream5 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iossolved);
            $errorStream5 = ssh2_fetch_stream($stream5, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream5, true);
            stream_set_blocking($stream5, true);
            $output = stream_get_contents($stream5);
            fclose($stream5);
            fclose($errorStream5);

            $stream7 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iosdns1);
            $errorStream7 = ssh2_fetch_stream($stream7, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream7, true);
            stream_set_blocking($stream7, true);
            $output = stream_get_contents($stream7);
            fclose($stream7);
            fclose($errorStream7);

            $stream8 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iosdns2);
            $errorStream8 = ssh2_fetch_stream($stream8, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream8, true);
            stream_set_blocking($stream8, true);
            $output = stream_get_contents($stream8);
            fclose($stream8);
            fclose($errorStream8);


            $stream6 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iossolved1);
            $errorStream6 = ssh2_fetch_stream($stream6, SSH2_STREAM_STDERR);
            stream_set_blocking($errorStream6, true);
            stream_set_blocking($stream6, true);
            $output = stream_get_contents($stream6);
            fclose($stream6);
            fclose($errorStream6);


        } else {
            echo 'baglanti başarısız..';
        }



    }
    public function ssh_add_paid_multiple($ip,$usercount = 100){
        $connect = $this->connect($ip);
        $server = ServerListModel::where('ip',$ip)->first();
        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'/var/www/vhosts/onevpns.com/httpdocs/vpn/keys/id_rsa.pub','/var/www/vhosts/onevpns.com/httpdocs/vpn/keys/id_rsa', '')) {
            // Session::put('loading','VPN Users Create');

            $server = ServerListModel::where('ip',$ip)->first();
            if ($server->paid == 0){

                for ($i = 0; $i<$usercount; $i++){

                    $user = 'user'.$i.time();

                    $stream1    = ssh2_exec($connect, 'docker exec -t ipsec-vpn-server /adduser.sh '.$user);
                    $errorStream= ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
                    stream_set_blocking($errorStream, true);
                    stream_set_blocking($stream1, true);
                    $output = stream_get_contents($errorStream);
                    fclose($stream1);
                    fclose($errorStream);

                    $parcala    = explode("Password", $output);


                    $user_add = new UserListModel();
                    $user_add->server_id = $server->id;
                    $user_add->country_id = $server->county_id;
                    $user_add->username = $user;

                    $z = 0 ;
                    foreach ($parcala as  $value) {
                        $bol = explode(':', $value);
                        if ($z == 0){
                            $user_add->secretid = trim($bol[1]);

                        }else{
                            $user_add->password = trim($bol[1]);
                        }
                        $z++;
                    }
                    $user_add->status = 0;
                    $user_add->paid = 0;
                    $user_add->save();


                }

            }
            else if ($server->paid == 1){
                for ($i = 0; $i<$usercount; $i++){

                    $user = 'user'.$i.time();

                    $stream1    = ssh2_exec($connect, 'docker exec -t ipsec-vpn-server /adduser.sh '.$user);
                    $errorStream= ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
                    stream_set_blocking($errorStream, true);
                    stream_set_blocking($stream1, true);
                    $output = stream_get_contents($errorStream);
                    fclose($stream1);
                    fclose($errorStream);

                    $parcala    = explode("Password", $output);


                    $user_add = new UserListModel();
                    $user_add->server_id = $server->id;
                    $user_add->country_id = $server->county_id;
                    $user_add->username = $user;

                    $z = 0 ;
                    foreach ($parcala as  $value) {
                        $bol = explode(':', $value);
                        if ($z == 0){
                            $user_add->secretid = trim($bol[1]);

                        }else{
                            $user_add->password = trim($bol[1]);
                        }
                        $z++;
                    }
                    $user_add->status = 0;
                    $user_add->paid = 1;
                    $user_add->save();


                }
            }


        } else {
            echo 'baglanti başarısız..';
        }
    }
    public function ssh_reset($ip){


        $connect = $this->connect($ip);
        $server = ServerListModel::where('ip',$ip)->first();

        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'keys/id_rsa.pub','keys/id_rsa', '')) {

            $users = UserListModel::where('server_id',$server->id)->delete();

            $usercount = 100;

            if ($server->sshuser != 'root'){//hasan_alper olanları bu yap
                ssh2_exec($connect,'cat /dev/null > /home/'.$server->sshuser.'/docker-ipsec-vpn-server/etc/ppp/chap-secrets');
                sleep(1);
                ssh2_exec($connect,'cat /dev/null > /home/'.$server->sshuser.'/docker-ipsec-vpn-server/etc/ipsec.d/passwd');
                sleep(1);
                $this->google_ssh_add_paid_multiple($ip,$usercount);
            }else{
                ssh2_exec($connect,'cat /dev/null > /root/docker-ipsec-vpn-server/etc/ppp/chap-secrets');
                sleep(1);
                ssh2_exec($connect,'cat /dev/null > /root/docker-ipsec-vpn-server/etc/ipsec.d/passwd');
                sleep(1);
                $this->ssh_add_paid_multiple($ip,$usercount);

            }

        } else {
            echo 'baglanti başarısız..';
        }
    }
    public function ssh_remove_user($ip,$user){

        $connect = $this->connect($ip);

        $server = ServerListModel::where('ip',$ip)->first();

        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'keys/id_rsa.pub','keys/id_rsa', '')) {

            ssh2_exec($connect, 'docker exec -t ipsec-vpn-server ipsec whack --deleteuser --name '.$user);
            ssh2_exec($connect,'docker exec -t ipsec-vpn-server /rmuser.sh '.$user);


            $stream1  = ssh2_exec($connect, 'docker exec -t ipsec-vpn-server /adduser.sh '.$user);
            sleep(1);

            stream_set_blocking($stream1, true);
            $stream_out = ssh2_fetch_stream($stream1, SSH2_STREAM_STDIO);
            $parcala    =   stream_get_contents($stream_out);
            $parcala    = explode("Password", $parcala);

            $server = ServerListModel::where('ip',$ip)->first();

            $deleteuser = UserListModel::where('server_id',$server->id)->where('username',$user)->delete();


            $user_add = new UserListModel();
            $user_add->server_id = $server->id;
            $user_add->country_id = $server->county_id;
            $user_add->username = $user;

            $z = 0 ;
            foreach ($parcala as  $value) {
                $bol = explode(':', $value);
                if ($z == 0){
                    $user_add->secretid = trim($bol[1]);

                }else{
                    $user_add->password = trim($bol[1]);
                }
                $z++;
            }
            $user_add->status = 1;
            $user_add->paid = $server->paid;
            $user_add->last_login_time = Carbon::now();
            $user_add->save();


        } else {
            echo 'baglanti başarısız..';
        }

    }
    public function ssh_disconnet($ip){
        //////Session::put('loading','Disconnet Server Processing soon');

        $connect = $this->connect($ip);
        unset($connect);

    }
    public function cronRestart(){
        $connection = ssh2_connect('localhost', 22);
        ssh2_auth_password($connection, 'root', '123Roshan');

        $stream4 = ssh2_exec($connection, 'cd '.base_path().';'.'/opt/plesk/php/7.0/bin/php artisan queue:work');

    }
    public function cronWork(){

        $connection = ssh2_connect('localhost', 22);
        ssh2_auth_password($connection, 'root', '123Roshan');

        $stream4 = ssh2_exec($connection, 'cd '.base_path().';'.'nohup /opt/plesk/php/7.0/bin/php artisan queue:listen');

    }
    public function ssh_ipsec($ip){
        $connect = $this->connect($ip);
        $server = ServerListModel::where('ip',$ip)->first();

        if (ssh2_auth_pubkey_file($connect, $server->sshuser,'keys/id_rsa.pub','keys/id_rsa', '')) {

            if ($server->sshuser != 'root'){
                $iossolved1 = 'sudo docker exec ipsec-vpn-server ipsec restart';
                $stream6 = ssh2_exec($connect, 'cd /home/'.$server->sshuser.'/docker-ipsec-vpn-server;'.$iossolved1);
                stream_set_blocking($stream6, true);
                $stream_out = ssh2_fetch_stream($stream6, SSH2_STREAM_STDIO);
                stream_get_contents($stream_out);

            }else{
                $iossolved1 = 'docker exec ipsec-vpn-server ipsec restart';
                $stream6 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iossolved1);
                $errorStream6 = ssh2_fetch_stream($stream6, SSH2_STREAM_STDERR);
                stream_set_blocking($errorStream6, true);
                stream_set_blocking($stream6, true);
                $output = stream_get_contents($stream6);
                fclose($stream6);
                fclose($errorStream6);
            }

        } else {
            echo 'baglanti başarısız..';
        }

    }

    public function ssh_ipsec_all(){

        $servers = ServerListModel::where('sshuser','root')->get();
        foreach ($servers as $server){

            $connect = $this->connect($server->ip);
            if (ssh2_auth_pubkey_file($connect, $server->sshuser,'/var/www/vhosts/onevpns.com/httpdocs/vpn/keys/id_rsa.pub','/var/www/vhosts/onevpns.com/httpdocs/vpn/keys/id_rsa', '')) {

                if ($server->sshuser != 'root'){
                    $log = new LogsCreate();
                    $log->create('ipSec',$server->ip,'1','0');
                    $iossolved1 = 'sudo docker exec ipsec-vpn-server ipsec restart';
                    $stream6 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iossolved1);
                    $errorStream6 = ssh2_fetch_stream($stream6, SSH2_STREAM_STDERR);
                    stream_set_blocking($errorStream6, true);
                    stream_set_blocking($stream6, true);
                    $output = stream_get_contents($stream6);
                    fclose($stream6);
                    fclose($errorStream6);

                }else{
                    $log = new LogsCreate();
                    $log->create('ipSec',$server->ip,'1','0');
                    $iossolved1 = 'docker exec ipsec-vpn-server ipsec restart';
                    $stream6 = ssh2_exec($connect, 'cd /root/docker-ipsec-vpn-server;'.$iossolved1);
                    $errorStream6 = ssh2_fetch_stream($stream6, SSH2_STREAM_STDERR);
                    stream_set_blocking($errorStream6, true);
                    stream_set_blocking($stream6, true);
                    $output = stream_get_contents($stream6);
                    fclose($stream6);
                    fclose($errorStream6);
                }

            } else {
                echo 'baglanti başarısız..';
            }
            sleep(1);
            unset($connect);
        }


    }



}