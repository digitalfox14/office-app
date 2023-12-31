<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date', 'loagged', 'break', 'over_time'];

    public function punchIn()
    {
        return $this->hasOne(AttendanceLogs::class, 'attendance_id', 'id')->orderBy('id', 'asc');
    }

    public function punchOut()
    {
        return $this->hasOne(AttendanceLogs::class, 'attendance_id', 'id')->orderBy('id', 'desc');
    }

    public function timesheetPunchin()
    {
        return $this->hasOne(AttendanceLogs::class, 'attendance_id', 'id')->orderBy('id', 'desc');
    }

}