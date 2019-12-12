<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public static function getUserInfo($userId){
        DB::select('select firstName, lastName, email, phone from users where id = ?',[$userId]);
    }

    public static function updateUserInfo(Request $request, $userId){
        DB::update('update users set phone = ? where name = ?',[$request->phone, $userId]);
    }
}
