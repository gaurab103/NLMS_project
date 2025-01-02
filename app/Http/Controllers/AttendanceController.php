```php
<?php

namespace App\Http\Controllers;

use App\Models\Attendance;

class AttendanceController extends Controller
{

    public function showAttendancePage()
    {
        $attendance = Attendance::all(); 

        return view('attendance', ['attendance' => $attendance]);
    }
}
