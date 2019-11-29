<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
        
    public static function getHotelImage($id){

        $HotelNum = DB::table('hotel_pictures')->where('hotelId',$id)->pluck('picturePath');
        $arr = [ ];
        foreach ($HotelNum as $picturePath){
            array_push($arr, $picturePath);
        }

        return json_encode($arr);
    }

    public static function getRoomImage($hotelId, $roomId){
        
    }
}
