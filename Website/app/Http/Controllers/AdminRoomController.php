<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminRoomController extends Controller
{
    public static function getRoomTypeForSelect2($hotelId) {
        $roomType = DB::select('select roomId, type from room_infos where hotelId = ?',[$hotelId]);

        $res = [];
        $group = json_decode("{}");
        $group->text = "Availability";
        $group->children = json_decode('[{"id": "Enabled", "text": "Enabled"}, {"id": "Disabled", "text": "Disabled"}]');
        array_push($res, $group);
        $typeGroup = json_decode("{}");
        $typeGroup->text = "Room Type";
        
        $arr = [];
        foreach($roomType as $type){
            $new = json_decode("{}");
            $new->id = $type->roomId;
            $new->text = $type->type;
            array_push($arr, $new);
        }
        $typeGroup->children = $arr;
        array_push($res, $typeGroup);
        $final = json_decode("{}");
        $final->results = $res;
        return json_encode($final);
    }

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

    public static function getAllRooms($hotelId){
        $rooms = DB::select('select roomNum, type, available from rooms 
        inner join room_infos 
        on rooms.hotelId = room_infos.hotelId AND rooms.roomId = room_infos.roomId
        where rooms.hotelId = ?;',[$hotelId]);

        $res = [];
        foreach ($rooms as $data) {
            $arr = [
                $data->roomNum,
                $data->type,
                ($data->available)
                    ? 'Enabled'
                    : 'Disabled',
                ($data->available) 
                    ? '<label class="text-success"><i class="fas fa-check"></i></label>' 
                    : '<label class="text-danger"><i class="fas fa-minus"></i></label>',
            ];
            array_push($res, $arr);
        }
        
        $final = json_decode("{}");
        $final->data = $res;
        return json_encode($final);
    }

    public static function updateRoomsAvailability(Request $request, $hotelId){
        $text = "";
        for ($i = 0; $i < count($request->rooms); $i++) {
            $text .= "'" . $request->rooms[$i] . "'";
            if ($i != count($request->rooms)-1)
                $text .= ",";
        }
        // return $request->available . " " . $hotelId;
        return DB::update('UPDATE rooms SET available=? WHERE hotelId=? AND roomNum IN (' . $text . ') ;',
            [$request->available, $hotelId]);
    }

    public static function getAvailableRoomNo(Request $request){
        $rooms = DB::select('Select rooms.roomId, type, roomNum, price, addBed from rooms
        inner join room_infos 
        on ((rooms.roomId = room_infos.roomId) and (rooms.hotelId = room_infos.hotelId)) 
        where (rooms.hotelId, rooms.roomNum) not in (Select booking_room.hotelId, booking_room.roomNum from bookings
        inner join booking_room
        where booking_room.roomNum is NOT NULL AND (bookings.bookingNum = booking_room.bookingNum) AND
        ( (checkInDate <= "'.$request->checkInDate.'" AND checkOutDate > "'.$request->checkInDate.'") OR 
        (checkInDate >= "'.$request->checkInDate.'" AND checkInDate < "'.$request->checkOutDate.'")))
        and rooms.hotelId = ?; ',[$request->hotelId]);

        // $rooms = DB::select('Select rooms.roomId, type, roomNum, price, addBed from rooms
        // inner join room_infos 
        // on ((rooms.roomId = room_infos.roomId) and (rooms.hotelId = room_infos.hotelId)) 
        // where rooms.hotelId=? and (rooms.hotelId, rooms.roomNum) not in (Select booking_room.hotelId, booking_room.roomNum from bookings
        // inner join booking_room
        // where (bookings.bookingNum = booking_room.bookingNum) AND
        // ( (checkInDate <= "'.$request->checkInDate.'" AND checkOutDate > "'.$request->checkInDate.'") OR 
        // (checkInDate >= "'.$request->checkInDate.'" AND checkInDate < "'.$request->checkOutDate.'")));', [$request->hotelId]);

        return json_encode($rooms);
    }

    public static function getBookingRoom(Request $request){
        $rooms = DB::select('select br.roomId, ri.type, br.addBed, br.roomNum, br.no from booking_room br inner join room_infos ri on (br.roomId=ri.roomId and br.hotelId=ri.hotelId) where bookingNum = ?',[$request->bookingNum]);

        return json_encode($rooms);
    }
}
