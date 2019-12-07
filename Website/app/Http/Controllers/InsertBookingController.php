<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsertBookingController extends Controller
{
    public static function newBooking($fullName, $email, $phone, $icNum, $checkInDate, $checkOutDate, 
    $remark, $adult, $child, $roomNum, $totalPrice, $hotelId, $roomId){
       $current = DB::select('select * from bookings');
       $bookingNum = count($current) + 1;

       $current2 = DB::select('select * from booking_room');
       $no = count($current2) + 1;

       $t=time();
       $bookingDate = date("Y-m-d H:i:s",$t);
    //    print_r($bookingNum); 
        
        $query = 'insert into bookings (bookingNum, fullName, email, phone, icNum, checkInDate, 
        checkOutDate, remark, adult, child, roomNo, totalPrice, hotelId, created_at, updated_at) 
        VALUES ( '.$bookingNum.', "'.$fullName.'", "'.$email.'", "'.$phone.'", "'.$icNum.'", "'.$checkInDate.'", "'
        .$checkOutDate.'", "'.$remark.'", '.$adult.', '.$child.', '.$roomNum.', '.$totalPrice.', '.$hotelId.', "'
        .$bookingDate.'", NULL);';

        DB::insert($query);

        $addBed = 0;
        for($i=0; $i<$roomNum; $i++){
            $query2 = 'insert into booking_room (no, bookingNum, hotelId, roomId, addBed, roomNum) VALUES ('
                .$no.', '.$bookingNum.', '.$hotelId.', '.$roomId[$i].', '.$addBed.', "pending");';
            
            DB::insert($query2);
            $no = $no + 1;
        }
        return "successful!!!";
    }

}
