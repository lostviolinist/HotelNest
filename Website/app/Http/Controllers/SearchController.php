<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    public static function calculate($pax, $room){
        $arr = [ ];
        $num = $room;
        for($i=0; $i<$num; $i++){
            $temp = $pax/$room;
            settype ($temp, "integer");
            array_push($arr, $temp);
            $pax = $pax - $temp;
            $room = $room - 1;
        }
        return $arr;
    }

    public static function searchHotelList($city="", $checkInDate="", $checkOutDate="", $adult=0, $child=0, $room=""){

        $totalPax = $adult + $child;
        $a = SearchController::calculate($totalPax, $room);

        $x =1;
        $num1 = $a[0];
        $num2 = 0;
        $numRoom1 = count($a);
        $numRoom2 = 0;

        
        for($i=0;$i<count($a)-1;++$i){
            if( $a[$i] != $a[$i+1]){
                $numRoom1 -= 1;
                $num1 = $a[$i+1];
                $numRoom2++;
                $num2 = $a[$i];
                $x = 2;
            }else{
                $num1 = $a[$i];
            }
        }

        $query = 'select hotelId from (
            select rooms.hotelId,(pax + addBed) AS b, COUNT(*) from rooms INNER JOIN room_infos 
            where rooms.hotelId = room_infos.hotelId 
            AND rooms.roomId = room_infos.roomId 
            AND (rooms.hotelId, rooms.roomNum) 
            not in (Select booking_room.hotelId, booking_room.roomNum from bookings inner join booking_room 
            where (bookings.bookingNum = booking_room.bookingNum) 
            AND ( (checkInDate <= "'.$checkInDate.'" AND checkOutDate > "'.$checkInDate.'") 
            OR (checkInDate >= "'.$checkInDate.'" AND checkInDate < "'.$checkOutDate.'"))) 
            And ( pax + addBed =' . $num1 .
            ($x > 1 ? ' OR pax + addBed ='.$num2 : ' ' ).
            ')
            GROUP BY hotelId,(pax + addBed)
            HAVING (COUNT(*)>= '. $numRoom1 .' and b= '.$num1.') '.
            
            ($x > 1 ? ' OR (COUNT(*)>= '.$numRoom2. ' and b= '.$num2. ') ' : "") .
            ') T 
            GROUP by hotelId
            HAVING COUNT(*)= '.$x;              
            
        
        $results = DB::select($query);

        $arr = [ ];
        foreach ($results as $hotel){           
            array_push($arr, $hotel);
        }

        return json_encode($arr);
    }

    public static function getHotelDetails($city="", $checkInDate="", $checkOutDate="", $adult=0, $child=0, $room=""){

        $hotelss = SearchController::searchHotelList($city, $checkInDate, $checkOutDate, $adult, $child, $room);
        $list = json_decode($hotelss);
        $arr = [ ];
        for($i=0; $i < count($list); $i++){
            $hotelId = $list[$i] -> hotelId;

            $HotelList = DB::table('room_infos')
                ->join('hotels','room_infos.hotelId','=','hotels.hotelId')
                ->join('hotel_pictures','hotels.hotelId','=','hotel_pictures.hotelId')
                ->select(DB::raw('room_infos.hotelId, name, city, star, hotels.description, min(price) as lowestPrice, picturePath'))
                ->groupBy('hotelId','name','city','star', 'description', 'picturePath')
                ->where('num','=','1')
                ->where('hotels.hotelId','=',$hotelId)
                ->get();

            foreach ($HotelList as $hotel){
        
                array_push($arr, $hotel);
            }
        }
        return json_encode($arr);
    }

    public static function getRoomDetails($hotelId){
        $RoomDetail = DB::table('room_infos')
            ->where('hotelId','=',$hotelId)
            ->get();

            return json_encode($RoomDetail); 
    }
 
}
