<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public static function searchHotelList($city="", $checkInDate="", $checkOutDate="", $adult="", $child="", $room=""){

        $HotelList = DB::table('room_infos')
            ->join('hotels','room_infos.hotelId','=','hotels.hotelId')
            ->join('hotel_pictures','hotels.hotelId','=','hotel_pictures.hotelId')
            ->select(DB::raw('room_infos.hotelId, name, city, star, min(price) as lowestPrice, picturePath'))
            ->groupBy('hotelId','name','city','star','picturePath')
            ->where('num','=','1')
            ->get();

        $arr = [ ];
        foreach ($HotelList as $hotel){
            
            array_push($arr, $hotel);
        }

        return json_encode($arr);
    }
}
