<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceLogs;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Vtiful\Kernel\Format;


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

    public function userAttendance(Request $request)
    {
        $selectMonth    = $request->month;
        $selectYear     = $request->year;
        $currentMonth   = date('m');
        $currentYear    = date('Y');

        if($selectMonth && $selectYear) {
            $users = User::where('role_id', 2)->with('attendances', function($query) use ($request) {
                                        $query->whereMonth('created_at', $request->month)
                                        ->whereYear('created_at', $request->year)->get();
                                        })->get();
        } else {
            $users = User::with('attendances')->where('role_id' , 2)->orWhere('created_at', $currentMonth && $currentYear)->get();
        }

        if($selectMonth && $selectYear) {
            $days  = range(1, cal_days_in_month(CAL_GREGORIAN, $selectMonth, $selectYear));
        } else {
            $days = range(1, cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear));
        }

        $dates  =  array_fill_keys(array_keys(array_flip($days)), 0);

        $attendances = [];

        foreach ($users as $key => $user) {
            $attendances[$key]['user'] = $user->name;
            $attendances[$key]['attendances'] = $dates;

            foreach ($user->attendances as $attendance) {
                $date = date('d', strtotime($attendance->date));
                $date = (int) $date;

                if (array_key_exists($date, $days)){
                    $attendances[$key]['attendances'][$date] = 1;
                }
            }
        }

        return response()->json(['days' => $days, 'attendances' => $attendances]);
    }
}