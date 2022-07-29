<?php

namespace App\Http\Middleware;

use Closure;
use App\SettingsVpn;
use App\Module\LogsCreate;

class Bundle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $str = $request->header('User-Agent');
        $from = '(';
        $to =';';
        $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
        $buid = substr($sub,0,strpos($sub,$to));

        $bundles = SettingsVpn::first();
        $bundlesArray = explode(',',$bundles->bundleid);

        foreach ($bundlesArray as $bundle){
            if ($buid === $bundle){
                return $next($request);
            }
        }
        $log = new LogsCreate();
        $log->create('Bundle','Bundle ID Error','1','1');

        $api['result'] = 'failure';
        $api['response'] = 'connection error';
        return response()->json($api, 404);




    }
}
