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
        $user           = $request->user();
        $selectMonth    = $request->month;
        $selectYear     = $request->year;
        $currentMonth   = date('m');
        $currentYear    = date('Y');

        if( $selectMonth && $selectYear) {
            $attendance = Attendance::with(['punchIn', 'punchOut'])->where('user_id', $user->id)
                                                                ->whereMonth('created_at', $selectMonth)
                                                                ->whereYear('created_at', $selectYear)->get();
        } else {
            $attendance = Attendance::with(['punchIn', 'punchOut'])->where('user_id', $user->id)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)->get();
        }
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
        $punchIn = AttendanceLogs::where('user_id', $user->id)->whereDate('created_at',  Carbon::today()->toDateString())->orderBy('id', 'asc')->first();
        $punchOut = AttendanceLogs::where('user_id', $user->id)->whereDate('created_at', Carbon::today()->toDateString())->orderBy('id', 'desc')->first();

        $start_punchIn  = Carbon::parse($punchIn->punch_in);
        $end_punchOut   = Carbon::parse($punchOut->punch_out);
        $total_time = $end_punchOut->diffInMinutes($start_punchIn);

        $punch->update([
            'punch_out' => Carbon::now()
        ]);

        $startTime = Carbon::parse($punch->punch_in);
        $endTime = Carbon::parse($punch->punch_out);

        $totalDuration = $endTime->diffInMinutes($startTime);

        $Attendance = Attendance::where('user_id', $user->id)
                                    ->orderBy('id', 'desc')
                                    ->first();
        

        $loagged_value  = $Attendance->loagged;
        $loagged        = $loagged_value + $totalDuration;
        $break          = $total_time - $loagged;

        if ($loagged > 480) {
            $overTime = $loagged - 480;
        } else {
            $overTime = null;
        }

        $Attendance->update([
            'loagged'   => $loagged,
            'break'     => $break,
            'over_time' => $overTime
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

    public function timeSheet(Request $request)
    {
        $user = $request->user();
        $timesheet = Attendance::with('timesheetPunchin')->where('user_id', $user->id)->orderBy('id' , 'desc')->first();

        return response()->json($timesheet);
    }

    public function statistics(Request $request)
    {
        $user = $request->user();
        $now = Carbon::now();


        $today = Attendance::where('user_id', $user->id)->orderBy('id' , 'desc')->first('loagged');
        $today = $today->loagged;
        $today_percentage = ($today / 480) * 100;


        $thisweek = Attendance::where('user_id', $user->id)->whereBetween("created_at", [
            $now->startOfWeek()->format('Y-m-d'),
            $now->endOfWeek()->format('Y-m-d')
        ])->sum('loagged');
        $week_percentage = ($thisweek / 2400) * 100;

        $thismonth = Attendance::where('user_id', $user->id)->whereBetween("created_at", [
            $now->startOfmonth()->format('Y-m-d'),
            $now->endOfmonth()->format('Y-m-d')
        ])->sum('loagged');
        $month_percentage = ($thismonth / 9600) * 100;

        $remaining_percentage = ((9600 -$thismonth) / 9600) * 100;

        if(9600 < $thismonth) {
        $over_time = ($thismonth - 9600);
        } else {
            $over_time = 0;
        }
        $over_percentage = ($over_time / 960) * 100;

        return response()->json([ 'today' => $today, 'thisweek' => $thisweek , 'thismonth' => $thismonth, 'week_percentage' => $week_percentage, 'month_percentage' => $month_percentage, 'today_percentage' => $today_percentage, 'remaining_percentage' => $remaining_percentage, 'over_time' => $over_time, 'over_percentage' => $over_percentage]);
    }
}