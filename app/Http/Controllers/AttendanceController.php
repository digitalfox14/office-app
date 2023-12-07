<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceLogs;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AttendanceController extends Controller
{
    public function punchIn(Request $request)
    {
        $user = $request->user();
        $attendance = Attendance::firstOrCreate([
            'user_id' => $user->id,
            'date'    => Carbon::today()->format('Y-m-d'),
           
        ]);
        
        $attendanceLog = AttendanceLogs::create([
            'user_id' => $user->id,
            'attendance_id' => $attendance->id,
            'punch_in'      => Carbon::now()
        ]);

        return response()->json($attendanceLog);
    }

    public function getAttendance(Request $request)
    {
        $attendance = Attendance::with(['punchIn', 'punchOut'])->get();

        return response()->json($attendance);
    }

    public function punchLog(Request $request)
    {
        $user = $request->user();
        $log = AttendanceLogs::where('user_id', $user->id)
                                ->whereDate('created_at', Carbon::today()->toDateString())
                                ->orderBy('id', 'DESC')
                                ->first();

        return response()->json($log);
    }

    public function punchOut(Request $request, $id)
    {
        $user = $request->user();
        $punch = AttendanceLogs::find($id);

        $punch->update([
            'punch_out' => Carbon::now()
        ]);

        $startTime = Carbon::parse($punch->punch_in);
        $endTime = Carbon::parse($punch->punch_out);

        $totalDuration = $endTime->diffInMinutes($startTime);

        $Attendance = Attendance::where('user_id', $user->id)
                                    ->orderBy('id', 'desc')
                                    ->first();
        $loagged_value = $Attendance->loagged;
        $Attendance->update([
            'loagged' => $loagged_value + $totalDuration
        ]);

        return response()->json($punch);
    }
}
