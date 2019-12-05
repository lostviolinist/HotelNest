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
        $pic = DB::table('room_pictures')->where([
            ['hotelId','=',$hotelId],
            ['roomId','=',$roomId]
        ])->pluck('picturePath');

        $arr = [ ];
        foreach ($pic as $picturePath){
            array_push($arr, $picturePath);
        }

        return json_encode($arr);
    }

    public static function getImage($hotelId){
        $picHotel = DB::table('hotel_pictures')->where('hotelId',$hotelId)->pluck('picturePath');
        $arr = [ ];
        foreach ($picHotel as $picturePath){
            array_push($arr, $picturePath);
        }

        $picRoom = DB::table('room_pictures')->where('hotelId',$hotelId)->pluck('picturePath');
        foreach ($picRoom as $picturePath){
            array_push($arr,$picturePath);
        }

        return json_encode($arr);
    }

    public static function getHomeImage($city){
        $id = DB::table('hotels')->where('city',$city)->pluck('hotelId');
        $arr = [ ];
        foreach ($id as $hotelId){
            $hotelPic = DB::table('hotel_pictures')->where([
                ['hotelId','=',$hotelId],
                ['num','=',1]
            ])->value('picturePath');

            array_push($arr, $hotelPic);
        }

        return json_encode($arr);

        
    }
}
