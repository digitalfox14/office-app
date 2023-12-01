<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['status' => 1]);
    }

    public function refreshUser(Request $request)
    {
      $user =  Auth::user();
    
      return response()->json($user);  
    }


}
