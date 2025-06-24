<?php

use App\Models\Pharmacy;
use Illuminate\Support\Facades\Route;

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


//Route::get('ph_report', function () {
//    $notInDb = Pharmacy::whereInDb(false)->get();
//    $new = Pharmacy::whereColumn('created_at', 'updated_at')->get();
//    return (new \App\Notifications\PharmaciesSyncNotification($new, $notInDb))->toMail((object)['name' => 'Admin', 'email' => 'test@test.com']);
//});