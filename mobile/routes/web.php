<?php

use App\User;
use Illuminate\Http\Request;

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
    return view('mainhome');
});

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');



// -----------------------------------------For Testing------------------------------------------------------
// -----------------------------------------For Testing------------------------------------------------------
// -----------------------------------------For Testing------------------------------------------------------
Route::resource('hotel', 'HotelController');

Route::post('hotel/update', 'HotelController@update')->name('hotel.update');

Route::get('hotel/destroy/{id}', 'Hotelcontroller@destroy');

// -----------------------------------------For mobile------------------------------------------------------
// -----------------------------------------For mobile------------------------------------------------------
// -----------------------------------------For mobile------------------------------------------------------

Route::post('loginUser',function(Request $request){
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Authentication passed...
        return $credentials['password'];
    }else{
        return "false";
    }
});
