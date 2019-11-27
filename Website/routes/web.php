<?php

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController;

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

// ------------------------------------- MANAGEMENT ----------------------------------- //

Route::get('management/book', function() {
    return view('management/book');
});

Route::get('management/bookings', function() {
    return view('management/bookings');
});

Route::get('management/profile', function() {
    return view('management/profile');
});

Route::get('management/change-password', function() {
    return view('management/change-password');
});

Route::get('management/sign-in', function() {
    return view('management/sign-in');
});

Route::post('management/sign-in', function(Request $request) {

    $status = false;
    $redirect = null;
    $error = null;
    $results = DB::select ('SELECT * FROM admins WHERE email=:email AND password=:password;', 
        ['email' => $request['email'], 'password' => $request['password']]);

    if (count($results) > 0) {
        $request->session()->flush();
        session(['management_admin_id' => $results[0]->id]);
        session(['management_hotel_name' => $results[0]->hotelName]);
        $status = true;
        $redirect = url('management/book');
    } else {
        $error = "Email and password combination are not valid.";
    }
    return response()->json([
        'status' => $status,
        'redirect' => $redirect,
        'error' => $error
    ]);
})->name('management/sign-in');

Route::get('management/sign-out', function() {
    session()->flush();
    return redirect('management/sign-in');
})->name('management/sign-out');

Route::post('management/change-password', function(Request $request) {

    $status = false;
    $error = null;
    if ($request['new-password'] == $request['confirm-password']) {
        $adminId = session('management_admin_id');
        $results = DB::select ('SELECT * FROM admins WHERE id=:id AND password=:password;', 
            ['id' => $adminId, 'password' => $request['current-password']]);
        if (count($results) > 0) {
            $results = DB::update('UPDATE admins SET password=:password WHERE id=:id', 
                ['password' => $request['new-password'], 'id' => $adminId]);
            if ($results == 0)
                $error = 'Failed to change password.';
            else
                $status = true;
        } else {
            $error = 'Please enter the correct current password.';
        }  
    } else {
        $error = 'The new password and password confirmed does not match.';
    }
    
    return response()->json([
        'status' => $status,
        'error' => $error,
    ]);
})->name('management/change-password');

// ------------------------------------- MANAGEMENT END ----------------------------------- //

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
