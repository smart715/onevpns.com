<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cron','HomeController@index');

Route::get('/admin/dashboard','AdminController@index');
Route::get('/admin','AdminController@login');
Route::post('/admin/post','AdminController@login_post');
Route::get('/admin/register','AdminController@register');
Route::get('/admin/serverview','AdminController@serverView');
Route::get('/admin/logs','AdminController@logsView');
Route::get('/admin/adduser/{countryid}/{usercount}','AdminController@adduser');
Route::get('/admin/reset/{countryid}','AdminController@resetuser');
Route::get('/admin/country','AdminController@countryGet');
Route::get('/admin/servermanuel','AdminController@servermanuelGet');
Route::post('/admin/servermanuel/post','AdminController@manuel_server_install');
Route::post('/admin/country/post','AdminController@countryPost');
Route::post('/admin/country/token','AdminController@token_digital');
Route::get('/admin/changePaid/{countryid}/{type}','AdminController@changePaid');
Route::get('/admin/deleteServer/{countryid}','AdminController@deleteServer');
Route::get('/admin/serverEdit/{countryid}','AdminController@serverEdit');
Route::get('/admin/hideshow/{countryid}/{status}','AdminController@hideshow');
Route::post('/admin/serverEdit/post','AdminController@serverEditPost');
Route::get('/admin/alternative/server','AdminController@alternativeServer');
Route::get('/admin/alternative/manuel','AdminController@manuel_alternative_get');
Route::post('/admin/alternative/manuel/post','AdminController@manuel_alternative_post');
Route::get('/admin/settings','AdminController@settingView');
Route::post('/admin/settings/post/cron','AdminController@settingPostcron');
Route::post('/admin/settings/post/sub','AdminController@settingPostsub');
Route::post('/admin/settings/post/bundle','AdminController@settingBundle');
Route::get('/admin/deleteServersub/{serverid}','AdminController@deleteServersub');
Route::get('/admin/addusersub/{serverid}/{usercount}','AdminController@adduserid');
Route::get('/admin/resetsub/{countryid}','AdminController@resetusersub');
Route::get('/admin/liveuser','AdminController@live_user');
Route::get('/admin/settingsCronControl','AdminController@settingsVpn');
Route::get('/admin/ipsec/{countryid}','AdminController@ipSecRestart');
Route::get('/admin/setting/cron','AdminController@cronReset');

Route::get('/admin/failed','AdminController@testQeues');
Route::get('/admin/ipsecall','AdminController@ssh_ipsec_all');

Route::middleware(['Bundle'])->group(function () {
    Route::middleware(['basicAuth'])->group(function () {
            Route::post('/setting','UsersController@setting');
            Route::post('/trafficstatus','TrafficController@index');
            Route::get('/countrylist','CountryListController@index');
            Route::post('/createuser','AuthController@createUser');
            Route::post('/storeIapReceipt','IAPController@storeIapReceipt');
            Route::post('/validateReceipt','IAPController@validateReceipt');
            Route::middleware(['APIToken'])->group(function () {
              Route::post('/users','UsersController@index');
            });
    });
});


Route::get('/countrylist2','CountryListController@index_two');

Route::get('/home', 'HomeController@index')->name('home');
