<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function updateProfile(Request $request) {
        $status = false;
        $error = null;
    
        $checkInTime = $request['check-in-time'];
        $checkOutTime = $request['check-out-time'];
        $description = $request['description'];
        $name = session('management_hotel_name');
    
        if (isset($checkInTime) && $checkInTime !== '' 
            && isset($checkOutTime) && $checkOutTime !== '' 
            && isset($description) && $description !== '') {
    
            try {
                DB::update('UPDATE hotels SET checkInTime=:checkInTime, 
                checkOutTime=:checkOutTime, description=:description WHERE name=:name;',
                ['checkInTime' => $checkInTime, 
                'checkOutTime' => $checkOutTime,
                'description' => $description,
                'name' => $name]);
                $status = true;
            } catch (Exception $e) {
                $error = 'Failed to update profile';
            }   
        } else {
            $error = 'Failed to update profile';
        }
        return response()->json([
            'status' => $status,
            'error' => $error
        ]);
    }
}
