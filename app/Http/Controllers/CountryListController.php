<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CountryModel;
use App\User;
use App\Module\LogsCreate;

class CountryListController extends Controller
{

    private $apiToken;
    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(str_random(60)));
    }

    public function index(){

        $token_update = User::where('id',1)->first();
        $token_update->api_token = $this->apiToken;
        $token_update->save();


        $input['id']='11,3,7,12,2,4,5,6,8,12,9';

        //$countries = CountryModel::select('id','regions as region','country','city','country_code','type')->get();
        $countries = CountryModel::select('id','regions as region','country','city','country_code','type','cat_server','locationtype')
            ->orderBy('id',54)
            ->orderBy('id',51)
            ->orderBy('type','asc')
            ->where('status',1)
            ->get();

        $api['result'] = 'success';
        $api['response'] = $countries;
        $api['access_token'] =$this->apiToken;


        return response()->json($api, 200);
    }

    public function index_two(){
        $token_update = User::where('id',1)->first();
        $token_update->api_token = $this->apiToken;
        $token_update->save();


        $input['id']='13,46,7,12,2,4,5,6,8,12,9';

        //$countries = CountryModel::select('id','regions as region','country','city','country_code','type')->get();
        $countries = CountryModel::select('id','regions as region','country','city','country_code','type','cat_server','locationtype')
            ->orderBy('id',54)
            ->orderBy('id',51)
            ->orderBy('type','asc')
            ->where('status',1)
            ->get();

        $api['result'] = 'success';
        $api['response'] = $countries;
        $api['access_token'] =$this->apiToken;


        return response()->json($api, 200);
    }

}
