<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsertBookingController extends Controller
{
    public static function newBooking($fullName, $email, $phone, $icNum, $checkInDate, $checkOutDate, 
    $remark, $adult, $child, $totalPrice, $hotelId, $roomId,$addBed){
       $current = DB::select('select bookingNum FROM bookings ORDER BY bookingNum DESC LIMIT 1');
        
       $bookingNum = ($current[0]->bookingNum)+1;

       $temp = json_decode($roomId);
       $temp2  = json_decode($addBed);

       $roomNum = count($temp);

       $current2 = DB::select('select * from booking_room');
       $no = count($current2) + 1;

       $t=time();
       $bookingDate = date("Y-m-d",$t);
        
        $query = 'insert into bookings (bookingNum, fullName, email, phone, icNum, checkInDate, 
        checkOutDate, remark, adult, child, roomNo, totalPrice, hotelId, created_at, updated_at) 
        VALUES ( '.$bookingNum.', "'.$fullName.'", "'.$email.'", "'.$phone.'", "'.$icNum.'", "'.$checkInDate.'", "'
        .$checkOutDate.'", "'.$remark.'", '.$adult.', '.$child.', '.$roomNum.', '.$totalPrice.', '.$hotelId.', "'
        .$bookingDate.'", NULL);';

        DB::insert($query);

        
        for($i=0; $i<$roomNum; $i++){
            
            $query2 = 'insert into booking_room (no, bookingNum, hotelId, roomId, addBed, roomNum) VALUES ('
                .$no.', '.$bookingNum.', '.$hotelId.', '.$temp[$i].', '.$temp2[$i].', NULL);';
            
            DB::insert($query2);
            $no = $no + 1;
        }
        return $bookingNum;
    }

    public static function getBookingDetail($bookingNum)
    {
        
        $info = DB::select('select * from bookings where bookingNum = ?',[$bookingNum]);

        $roomInfo = DB::select('select booking_room.roomId, type, COUNT(*) as number from booking_room INNER JOIN room_infos
        Where (booking_room.hotelId = room_infos.hotelId)
        AND (booking_room.roomId = room_infos.roomId)
        AND bookingNum = ? GROUP BY booking_room.roomId, type;',[$bookingNum]);

        $arr = [];
        
        for($i = 0; $i<count($roomInfo); $i++){
            array_push($arr, $roomInfo[$i]);
        }
        $info[0]->rooms = $arr;

        return json_encode($info[0]);
        

    }

}
