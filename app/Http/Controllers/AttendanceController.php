<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceLogs;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function userAttendance(Request $request)
    {
        
        $user = $request->user();
        $date = Carbon::now()->format('Y-m-d');
        $punchIn = Carbon::now()->format('H:m:s');
        $attendance = Attendance::create([
            'user_id' => $user->id,
            'date'    => $date,
           
        ]);
        
        $attendanceLog = AttendanceLogs::create([
            'user_id' => $user->id,
            'attendance_id' => $attendance->id,
            'punch_in'      => $punchIn
        ]);
        return response()->json($attendanceLog);
    }

    public function createLog(Request $request)
    {
        $attLog = AttendanceLogs::all();
        return response()->json($attLog);
    }
}
