<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRoomController extends Controller
{
    public static function getRoomType($hotelId){
        $roomType = DB::select('select * from room_infos where hotelId = ?',[$hotelId]);

        return json_encode($roomType);

        // [{"hotelId":1,"roomId":1,"type":"Twin Sharing Room D","price":60,"pax":2,"description":"This double room features a electric kettle, air conditioning and satellite TV.","addBed":1,"created_at":null,"updated_at":null},
        // {"hotelId":1,"roomId":2,"type":"Twin Sharing Room LY","price":200,"pax":2,"description":"Good room","addBed":0,"created_at":null,"updated_at":null},
        // {"hotelId":1,"roomId":3,"type":"Standard Single Room","price":150,"pax":1,"description":"Good room for single","addBed":0,"created_at":null,"updated_at":null}]
    }
}
