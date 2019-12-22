<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    public static function deleteBooking(Request $request, $hotelId, $bookingNum){
        
        try{
            DB::delete('delete bookings, booking_room from bookings 
            inner join booking_room
            on (bookings.bookingNum = booking_room.bookingNum)
            where bookings.hotelId = ?
            and bookings.bookingNum = ?;',[$hotelId, $bookingNum]);

        }catch(Exception $e){
            echo $e;
            return "false";
        }
        return "true";
    }

    public static function updateBooking(Request $request) {

        $hotelId = $request->hotelId;
        $bookingNum = $request->bookingNum;

        // booking detail
        $checkInDate = $request->checkInDate;
        $checkOutDate = $request->checkOutDate;

        // room assignment
        $no = $request->no;             // array
        $roomNum = $request->roomNum;   // array

        DB::update('update bookings set checkInDate=?, checkOutDate=? where hotelId=? and bookingNum=?;',
            [$checkInDate, $checkOutDate, $hotelId, $bookingNum]);

        for ($i = 0; $i < count($no); $i++) {
            DB::update('update booking_room set roomNum=? where no=?;',
                [$roomNum[$i], $no[$i]]);
        }
    }

    public static function editBooking(Request $request, $hotelId, $bookingNum){
        try{
            $roomNumber = count($request->roomNo);
            $current = DB::select('select * from booking_room');
            $no = count($current) + 1;

            DB::update('update bookings set checkInDate = ?, checkOutDate = ?, adult = ?, child = ?, roomNo = ?
             where hotelId = ? AND bookingNum = ?',
            [$request->checkInDate, $request->checkOutDate, $request->$adult, $request->child, $roomNumber,
            $hotelId, $roomNum]);

            DB::delete('delete from booking_room where bookings.hotelId = ? and bookings.bookingNum = ?;',
            [$hotelId, $bookingNum]);

            for($i=0;$i<$roomNumber;$i++){
                $query2 = 'insert into booking_room (no, bookingNum, hotelId, roomId, addBed, roomNum) VALUES ('
                    .$no.', '.$bookingNum.', '.$hotelId.', '.$request->$roomId[$i].', '.$addBed.','.
                    $request->roomNum[$i].');';
                
                DB::insert($query2);
                $no = $no + 1;                
            }

        }catch(Exception $e){
            echo $e;
        }
    }
}
