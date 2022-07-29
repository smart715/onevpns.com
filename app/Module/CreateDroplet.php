<?php

namespace App\Module;

use App\ServerListModel;
use App\LogsModel;
use App\CountryModel;
use App\DigitalModel;
use App\Module\LogsCreate;

use Illuminate\Support\Facades\Log;

/**
 * Digital Ocean api Process
 */
class CreateDroplet
{


    public function create($country_id,$dropletname,$status){
      
        $digital = DigitalModel::first();
        $this->digitalocean();


        $country = CountryModel::where('id',$country_id)->first();
        $sshkey = $digital->sshid;
        $sshkey = array($sshkey);

        $curl = curl_init();
        $fields = array(
                   'name' => $dropletname,
                   'region' => $country->regions,
                  // 'region' => 'nyc3',
                   'size' => 's-1vcpu-1gb',
                   'image' => 'ubuntu-18-04-x64',
                   'ssh_keys' => $sshkey,
                   'backups' => false,
                   'ipv6' => false,
                   'user_data' => null,
                   'private_networking' => null,
                   'volumes' => null,
                   'tags' => null,
            );
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.digitalocean.com/v2/droplets",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$digital->token,
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 03a277e5-b542-1f1f-6aae-d7e6b5f44638"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);


        if ($err) {
            echo "cURL Error #:" . $err;
            $log = new LogsCreate();
            $log->create('Digitalocean',$err,'9','1');
            exit();
            //curl hatası kontrol et..; burada mail attır ..
            
        } else {

            $response = json_decode($response);



            if (isset($response->message)){
                $log = new LogsCreate();
                $log->create('Digitalocean',$response->message,'9','1');

                var_dump($response);
                exit();
                $create = $response;
                $this->create = $create;

                return $create;
            }else{
                $create = $response;
                //burada sunucu ip'si 0.0.0.0 yolla id diziye at.
                $server = new ServerListModel();
                $server->droplet_id = $create->droplet->id;
                $server->county_id =$country_id;
                $server->ip = '0.0.0.0';
                $server->status = 0;
                $server->paid = $status;
                $server->save();

                return $create;
            }

        }

    }

    public function ip($dropletid){

        $digital = DigitalModel::first();

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.digitalocean.com/v2/droplets/".$dropletid,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ".$digital->token,
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "postman-token: aaefef2b-111d-d106-123e-1a31016fa79e"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $response = json_decode($response);

                if (isset($response->message)){
                    //loglara kaydet ve hata var demek.
                    $ip = $response->message;
                    $this->create = $ip;

                    return $ip;
                }else{
                    $ip = $response;

                    return $ip;
                }
            }

    }

    public function droplet($country_id,$dropletname,$status){
        $create     = $this->create($country_id,$dropletname,$status);
        if (isset($create->message)){
            if ($create->message == 'You have reached your droplet limit.'){
                echo 'limit dolu';
                //tekrar create token yolla. bunun kontrolü ana users da olacak..
            }else{
                echo 'bilinmedik bir hata';
                //mail attır. create->message bunu attır mail.
            }
        }


        $droplet  = $create->droplet->id;
        sleep(160);
        $ip         = $this->ip($droplet);
        if (!isset($ip->droplet->networks->v4[1]->ip_address)){
            sleep(50);
            $ip  = $this->ip($droplet);
        }
        $ipv4 = $ip->droplet->networks->v4[1]->ip_address;

            $server = ServerListModel::where('droplet_id',$create->droplet->id)->first();
            $server->ip =$ipv4;
            $server->status = 0;
            $server->sshuser ='root';
            $server->save();
            return $server;

    }


    public function digitalocean(){

        $ssh_islem = DigitalModel::first();

        if (is_null($ssh_islem->sshid)){

            $keys = file_get_contents('keys/id_rsa.pub');


            $curl = curl_init();
            $fields = array(
                'name' => 'sshkey3',
                'public_key' => $keys,
            );

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.digitalocean.com/v2/account/keys",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer ".$ssh_islem->token,
                    "cache-control: no-cache",
                    "content-type: application/json",
                    "postman-token: 6c8a3c4b-755a-8c85-a7b4-7e6470110431"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;

                print_r($err);

            } else {
                echo $response;
            }

            $sshkeys = json_decode($response);
            $ssh_islem->sshid = $sshkeys->ssh_key->id;
            $ssh_islem->save();

        }


    }




}