<?php

use Illuminate\Http\Request;
use App\Order;
use App\Client;
use App\Pharmacy;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| Clients Routes
|--------------------------------------------------------------------------
*/
Route::get('clients', function() {
    return Client::all();
});

Route::get('clients/{id}', function($id) {
    return Client::find($id)->load('orders');
});

Route::post('clients/add', function(Request $request) {
    // TODO: send the code by SMS
    $code = mt_rand(1000, 9999);

    return Client::create([
        "social_num" => $request->social_num,
        "first_name" => $request->first_name,
        "last_name" => $request->last_name,
        "address" => $request->address,
        "town" => $request->town,
        "tel" => $request->tel,
        "password" => $code,
        "confirmed" => false,
    ]);
});

/*
|--------------------------------------------------------------------------
| Orders Routes
|--------------------------------------------------------------------------
*/
Route::get('orders', function() {
    return Order::all();
});

Route::post('orders/add', function(Request $request) {
    // TODO: store file 

    return Order::create([
        "description" => $request->description,
        "status" => 0,
        "client_id" => $request->client_id,
        "pharmacy_id" => $request->pharmacy_id,
    ]);
});

Route::get('orders/{id}', function($id) {
    return Order::find($id)->load('client','pharmacy');
});

/*
|--------------------------------------------------------------------------
| Pharmacies Routes
|--------------------------------------------------------------------------
*/
Route::get('pharmacies', function() {
    return Pharmacy::all();
});

Route::get('pharmacies/wilaya/{code}', function($code) {
    return Pharmacy::where('town',$code)->get();
});

Route::get('pharmacies/{id}', function($id) {
    return Pharmacy::find($id)->load('orders','caisses');
});