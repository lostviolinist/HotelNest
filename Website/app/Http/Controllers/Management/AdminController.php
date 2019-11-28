<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
USE Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function signOut() {
        session()->flush();
        return redirect('management/sign-in');
    }

    public function signIn(Request $request) {
        $status = false;
        $redirect = null;
        $error = null;

        $email = $request['email'];
        $password = $request['password'];

        if (isset($email) && $email !== ''
            && isset($password) && $password !== '') {
            try {
                $results = DB::select ('SELECT * FROM admins WHERE email=:email AND password=:password;', 
                    ['email' => $email, 'password' => $password]);
                if (count($results) > 0) {
                    $request->session()->flush();
                    session(['management_admin_id' => $results[0]->id]);
                    session(['management_hotel_name' => $results[0]->hotelName]);
                    $status = true;
                    $redirect = url('management/book');
                } else {
                    $error = "Email and password combination are not valid";
                }
            } catch (Exception $e) {
                $error = 'Failed to sign in';
            }
        } else {
            $error = 'Failed to sign in';
        }

        return response()->json([
            'status' => $status,
            'redirect' => $redirect,
            'error' => $error
        ]);
    }

    public function changePassword(Request $request) {    
        $status = false;
        $error = null;
        $currentPassword = $request['current-password'];
        $newPassword = $request['new-password'];
        $confirmPassword = $request['confirm-password'];

        if (isset($currentPassword) && $currentPassword !== '' 
            && isset($newPassword) && $newPassword !== ''
            && isset($confirmPassword) && $confirmPassword !== ''
            && $newPassword === $confirmPassword) {

            $adminId = session('management_admin_id');
            try {
                $results = DB::select ('SELECT * FROM admins WHERE id=:id AND password=:password;', 
                    ['id' => $adminId, 'password' => $currentPassword]);
                if (count($results) > 0) {
                    $results = DB::update('UPDATE admins SET password=:password WHERE id=:id', 
                        ['password' => $newPassword, 'id' => $adminId]);
                    $status = true;
                } else {
                    $error = 'Wrong current password';
                }  
            } catch (Exception $e) {
                $error = 'Failed to change password';
            }
        } else {
            $error = 'Failed to change password';
        }
        
        return response()->json([
            'status' => $status,
            'error' => $error,
        ]);
    }
}
