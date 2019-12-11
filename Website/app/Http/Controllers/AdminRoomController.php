<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomController extends Controller
{
    public static function getRoomType($hotelId){
        $roomType = DB::select('select * from room_infos where hotelId = ?',[$hotelId]);

        $res = [];
        foreach($roomType as $type){
            $arr = [
                $type->type,
                ($type->addBed > 0) ? ($type->pax . " + " . $type->addBed) : ($type->pax),
                $type->description,
                '<button class="btn btn-outline-primary" onclick="editRoomType(this, '.$type->roomId.')">
                    <i class="fas fa-edit"></i>
                </button>'
            ];
            array_push($res, $arr);
        }
        $final = json_decode("{}");
        $final->data = $res;
        return json_encode($final);

        // [{"hotelId":1,"roomId":1,"type":"Twin Sharing Room D","price":60,"pax":2,"description":"This double room features a electric kettle, air conditioning and satellite TV.","addBed":1,"created_at":null,"updated_at":null},
        // {"hotelId":1,"roomId":2,"type":"Twin Sharing Room LY","price":200,"pax":2,"description":"Good room","addBed":0,"created_at":null,"updated_at":null},
        // {"hotelId":1,"roomId":3,"type":"Standard Single Room","price":150,"pax":1,"description":"Good room for single","addBed":0,"created_at":null,"updated_at":null}]
    }

    public static function updateRoomType(Request $request, $hotelId){
        DB::update('UPDATE room_infos SET type=?, description=? WHERE hotelId=? AND roomId=?',
            [$request->typeName, $request->description, $hotelId, $request->roomId]);
    }

    public static function getAllRoom($hotelId){
        $rooms = DB::select('select roomNum, type, available from rooms
        inner join room_infos
        where (rooms.roomId = room_infos.roomId)
        and rooms.hotelId = ?;',[$hotelId]);

        $final = json_decode("{}");
        $final->data = $rooms;
        return json_encode($final);
    }

    public static function updateRoomAvailability(Request $request, $hotelId, $roomNum){
        DB::update('update rooms set available = ? where hotelId = ? AND roomNum = ?',
            [$request->available, $hotelId, $roomNum]);
    }

    //delete booking

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

    //edit booking


}
