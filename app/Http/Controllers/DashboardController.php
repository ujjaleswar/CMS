<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\Students;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
     public function index()
    {
        // Efficient count queries
        $totalStudents = Students::count();
        $approvedStudents =Attendance ::where('status', 'approved')->count();
        $rejectedStudents = Attendance::where('status', 'rejected')->count();
        $pendingStudents = Attendance::where('status', 'pending')->count();

        $totalTeachers = Teacher::count();
        $totalSubjects = Subject::count();
        $totalSchedules = Schedule::count();

        // Monthly Applications Chart (last 6 months)
        $months = [];
        $monthlyApplications = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $months[] = $month->format('M');
            $monthlyApplications[] = Students::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
        }

        return view('dashboard', compact(
            'totalStudents',
            'approvedStudents',
            'rejectedStudents',
            'pendingStudents',
            'totalTeachers',
            'totalSubjects',
            'totalSchedules',
            'months',
            'monthlyApplications'
        ));
    }
}
