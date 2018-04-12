<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UwumController extends Controller
{
    function checkUser(Request $request) {
        $isUwumUserLoggedIn = $request->input('is_logged_in');
        $uwumUserId = $request->input('user_id');
        $action = 'none';

        if(($isUwumUserLoggedIn == 'true' && !Auth::check()) || ($isUwumUserLoggedIn == 'true') && Auth::id() != $uwumUserId) {
           $action = 'login';
        }
        if($isUwumUserLoggedIn == 'false' && Auth::check()) {
            if(User::find(Auth::id())->role_id != 1) {
                $action = 'logout';
                Auth::logout();

                if($request->session()->exists('uwumAccessToken')) {
                    $request->session()->forget('uwumAccessToken');
                }
            }
        }
        
        return response()->json([
            'action' => $action,
            'check' => (Auth::check() ? 'yes' : 'no')
        ]);
    }
}
