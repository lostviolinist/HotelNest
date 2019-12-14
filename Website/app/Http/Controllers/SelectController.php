<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectController extends Controller
{
    public static function getHotelInfo($hotelId){
        $info = DB::select('select * from hotels
        inner join hotel_facilities
        on (hotels.hotelId = hotel_facilities.hotelId)
        where hotels.hotelId = ?',[$hotelId]);
        return json_encode($info);
    }

    public static function getRoomInfo($hotelId, $checkInDate="", $checkOutDate=""){
        
        $query = 'select * from (Select rooms.roomId, type, price, pax, description, addBed, COUNT(*) as availableNum from rooms 
        INNER JOIN room_infos where (rooms.hotelId = room_infos.hotelId) AND (rooms.roomId = room_infos.roomId) 
        and rooms.hotelId = '.$hotelId. 
        ' and (rooms.hotelId, rooms.roomNum) not in (Select booking_room.hotelId, booking_room.roomNum from bookings
        inner join booking_room
        where (bookings.bookingNum = booking_room.bookingNum) AND
        ( (checkInDate <= "'.$checkInDate.'" AND checkOutDate > "'.$checkInDate.'") 
        OR (checkInDate >= "'.$checkInDate.'" AND checkInDate < "'.$checkOutDate.'")))
        GROUP BY roomId, type, price, pax, description, addBed) T inner join room_facilities 
        on (t.roomId = room_facilities.roomId)
        where hotelId = '.$hotelId;

        $result = DB::select($query);

        $arr = [ ];

        foreach($result as $rooms){
            array_push($arr, $rooms);
        }

        return json_encode($arr);
    }
    // public static function getRecommend()
}
