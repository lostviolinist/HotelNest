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

Route::resource('user','UserController');

Route::get('/form',function(){
	return view('user.create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('hotel', 'HotelController');

Route::post('hotel/update', 'HotelController@update')->name('hotel.update');

Route::get('hotel/destroy/{id}', 'Hotelcontroller@destroy');


Route::get('/hello',function(){
    return 'hello world';
});

Route::get('/userTest/{id}',function($id){
    $data = User::findOrFail($id);
    return $data['firstName'];
});