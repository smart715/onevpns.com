<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Module\SshConnect;

class HomeController extends Controller
{

    public function index()
    {
        $ssh = new SshConnect();
        $ssh->cronWork();
    }
}
