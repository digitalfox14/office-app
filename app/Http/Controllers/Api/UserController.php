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
        // die('im here');
        Auth::logout();
        return response()->json(['status' => 1]);
    }

    public function userName(Request $request)
    {
      $user =  Auth::user();
    
      return response()->json($user);  
    }


}
