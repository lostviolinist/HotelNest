<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public static function getUserInfo($userId){
        $user = DB::select('select firstName, lastName, email, phone from users where id = ?',[$userId]);
        return json_encode($user);
    }

    public static function updateUserInfo(Request $request, $userId){
        $user = DB::update('update users set phone = ? where name = ?',[$request->phone, $userId]);
        return json_encode($user);
    }

    public static function getBookingHistory($email){
        $booking = DB::select('select T.hotelId, T.bookingNum, T.name, T.checkInDate, T.checkOutDate, type, T.num 
        from room_infos 
        inner join (select bookings.hotelId, bookings.bookingNum, hotels.name, checkInDate, checkOutDate, 
            roomId, COUNT(*) as num from bookings 
        inner join booking_room on (bookings.bookingNum = booking_room.bookingNum)
        inner join hotels on (bookings.hotelId = hotels.hotelId)
        where email = ? 
        group by bookings.hotelId, bookings.bookingNum, hotels.name, checkInDate, checkOutDate, roomId
        order by checkOutDate DESC) T 
        on (T.roomId = room_infos.roomId)
        where room_infos.roomId = T.roomId and room_infos.hotelId = T.hotelId;',[$email]);

        return json_encode($booking);

    }
}
