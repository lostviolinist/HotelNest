<?php

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SearchController;

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

Route::get('/choose',function(){
    return view('choose');
});

// ------------------------------------- MANAGEMENT ----------------------------------- //

Route::get('management/book', function() {
    return view('management/book');
});

Route::get('management/bookings', function() {
    return view('management/bookings');
});

Route::get('management/profile', function() {
    try {
        $results = DB::select('SELECT * FROM hotels WHERE name=?;', 
            [session('management_hotel_name')]);
        if (count($results) > 0) {
            return view('management/profile', ['hotel' => $results[0]]);
        }
    } catch (Exception $e) {
        return 'Invalid hotel.';
    }
    return 'Invalid hotel.';
});

Route::post('management/update-profile', 
    'Management\HotelController@updateProfile')
    ->name('management/update-profile');

Route::get('management/change-password', function() {
    return view('management/change-password');
});

Route::get('management/sign-in', function() {
    return view('management/sign-in');
});

Route::post('management/sign-in', 
    'Management\AdminController@signIn')
    ->name('management/sign-in');

Route::get('management/sign-out', 
    'Management\AdminController@signOut')
    ->name('management/sign-out');

Route::post('management/change-password', 
    'Management\AdminController@changePassword')
    ->name('management/change-password');

// ------------------------------------- MANAGEMENT END ----------------------------------- //

// -----------------------------------------For Testing------------------------------------------------------
// -----------------------------------------For Testing------------------------------------------------------
// -----------------------------------------For Testing------------------------------------------------------
Route::resource('hotel', 'HotelController');

Route::post('hotel/update', 'HotelController@update')->name('hotel.update');

Route::get('hotel/destroy/{id}', 'Hotelcontroller@destroy');

Route::resource('testbooking', 'BookingController');

Route::post('testbooking/update', 'BookingController@update')->name('testbooking.update');

Route::get('testbooking/destroy/{id}', 'BookingController@destroy');

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

Route::post('registerUser',function(Request $request){
    $data = $request->only('firstName','lastName','email','password','phone');
    try{
        RegisterController::create($data);
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    return "true";
})->name('registerUser');

Route::post('search',function(Request $request){
    $data = $request->only('city','checkInDate','checkOutDate','adult','child','room');
    try{
        $hotels = SearchController::getHotelDetails();
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    return $hotels;
})->name('search');
