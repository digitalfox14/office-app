<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'date'];

    public function punchIn()
    {
        return $this->hasOne(AttendanceLogs::class, 'attendance_id', 'id')->orderBy('id', 'asc');
    }

    public function punchOut()
    {
        return $this->hasOne(AttendanceLogs::class, 'attendance_id', 'id')->orderBy('id', 'desc');
    }
}