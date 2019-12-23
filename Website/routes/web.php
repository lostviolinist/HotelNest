<?php

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SelectController;
use App\Http\Controllers\InsertBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;

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
})->name('mainhome');

Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::get('/choose',function(){
    return view('choose');
})->name('choose');

Route::get('/hotelpage',function(){
    return view('hotelpage');
})->name('hotelpage');

Route::get('/room',function(){
    return view('room');
});

Route::get('/confirm',function(){
    return view('confirm');
})->name('confirm');

Route::get('/booking',function(){
    return view('booking');
})->name('booking');


// ------------------------------------- MANAGEMENT ----------------------------------- //

Route::get('management/book', function() {
    return view('management/book');
});

Route::get('management/bookings', function() {
    return view('management/bookings');
})->name('management/bookings');

Route::get('management/rooms', function() {
    return view('management/rooms');
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

Route::get('management/getAvailableRoomNo', 
    'AdminRoomController@getAvailableRoomNo')
    ->name('management/getAvailableRoomNo');

Route::get('management/getBookingRoom', 
    'AdminRoomController@getBookingRoom')
    ->name('management/getBookingRoom');

Route::post('management/updateBooking', 
    'AdminBookingController@updateBooking')
    ->name('management/updateBooking');

// ------------------------------------- MANAGEMENT END ----------------------------------- //

// -----------------------------------------For Testing------------------------------------------------------
// -----------------------------------------For Testing------------------------------------------------------
// -----------------------------------------For Testing------------------------------------------------------
Route::resource('hotel', 'HotelController');

Route::post('hotel/update', 'HotelController@update')->name('hotel.update');

Route::get('hotel/destroy/{id}', 'Hotelcontroller@destroy');

Route::get('management/hotel/{hotelId}/bookings', 'BookingController@index')->name('management/hotel/bookings');
Route::get('management/hotel/{hotelId}/roomTypes', 'AdminRoomController@getRoomType')->name('management/hotel/roomTypes');
Route::get('management/hotel/{hotelId}/roomTypesForSelect2', 'AdminRoomController@getRoomTypeForSelect2')->name('management/hotel/roomTypesForSelect2');
Route::post('management/hotel/{hotelId}/updateRoomTypes', 'AdminRoomController@updateRoomType')->name('management/hotel/updateRoomType');
Route::get('management/hotel/{hotelId}/rooms', 'AdminRoomController@getAllRooms')->name('management/hotel/rooms');
Route::post('management/hotel/{hotelId}/updateRoomsAvailability', 'AdminRoomController@updateRoomsAvailability')->name('management/hotel/updateRoomsAvailability');
Route::post('management/hotel/{hotelId}/booking/{bookingId}/deleteBooking', 'AdminBookingController@deleteBooking')->name('management/hotel/booking/delete');

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
        $userId = DB::select('select id from users where email=?;', [$request->email]);
        return $userId;
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
    //$data = $request->only('city','checkInDate','checkOutDate','adult','child','room');
    try{
        $hotels = SearchController::getHotelDetails($request->city, $request->checkInDate, $request->checkOutDate, 
        $request->adult, $request->children, $request->room);
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    return $hotels;
})->name('search');

Route::post('hotelInfo',function(Request $request){
    //$data = $request->only('hotelId');
    try{
        $hotelInfo = SelectController::getHotelInfo($request->hotelId);
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    return $hotelInfo;
})->name('hotelInfo');

Route::post('roomAvailable',function(Request $request){
    // $data = $request->only('hotelId','checkInDate','checkOutDate');
    try{
        $roomInfo = SelectController::getRoomInfo($request->hotelId, $request->checkInDate, $request->checkOutDate);
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    return $roomInfo;
})->name('roomAvailable');

Route::post('createBooking',function(Request $request){
    // $data = $request->only('fullName', 'email', 'phone', 'icNum', 'checkInDate', 'checkOutDate', 
    // 'remark', 'adult', 'child', 'roomNum', 'totalPrice', 'hotelId', 'roomId');
    
    // roomId must be an array....
    // addBed must be an array.... correspond to roomId

    try{
        return InsertBookingController::newBooking($request->fullName, $request->email, $request->phone, $request->icNum, 
        $request->checkInDate, $request->checkOutDate, $request->remark, $request->adult, $request->child,
         $request->totalPrice, $request->hotelId, $request->roomId, $request->addBed);
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    
})->name('createBooking');

Route::get('confirmBookingDetails',function(Request $request){
    // $data = $request->only('bookingNum');

    try{
        $details = InsertBookingController::getBookingDetail($request->bookingNum);
    }catch(Exception $e){
        echo $e;
        return "false";
    }
    return $details;

})->name('confirmBookingDetail');

Route::get('userProfile', function(Request $request){
    try{
        $userInfo = UserController::getUserInfo($request->userId);
        $bookingInfo = UserController::getBookingHistory($request->email);

        $userInfo[0]->bookingInfo = $bookingInfo;
	return json_encode($userInfo);
    }catch(Exception $e){
        echo $e;
        return "false";
    }

    

})->name('userProfile');