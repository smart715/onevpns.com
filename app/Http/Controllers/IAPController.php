<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\IAPModel;
use Carbon\Carbon;

class IAPController extends Controller
{
    public function validateReceipt(Request $request){

        $iap = IAPModel::where('uuid',$request->uuid)->orderBy('id', 'desc')->first();
        $iap->frontend_verify_receipt_status = $request->status;
        $iap->applesharedsecret = $request->applesharedsecret;
        $iap->receipt = $request->receipt;
        $iap->save();

        $api['result'] = 'success';
        $api['response'] = "success";
        return response()->json($api, 200);
    }

    public function storeIapReceipt(Request $request){

        $iap = New IAPModel();
        $iap->uuid = $request->uuid;
        $iap->iap_transaction_date = $request->iap_transaction_date;
        $iap->iap_product_locale = $request->iap_product_locale;
        $iap->iap_product_price = $request->iap_product_price;
        $iap->iap_transaction_original_id = $request->iap_transaction_original_id;
        $iap->iap_transaction_state = $request->iap_transaction_state;
        $iap->iap_product_id = $request->iap_product_id;
        $iap->iap_transaction_id = $request->iap_transaction_id;
        $iap->save();

        $api['result'] = 'success';
        $api['response'] = "success";
        return response()->json($api, 200);
    }



}
