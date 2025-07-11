<?php

namespace App\Http\Controllers;

use App\Models\Myclass;
use App\Models\Schedule;
use App\Models\Students;
use App\Models\StudentsAttedance;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsAttedanceController extends Controller
{
    public function submitAttendance(Request $request)
    {
        $user = Auth::user();
        $teacher = Teacher::where('userID', $user->id)->firstOrFail();

        $selectedDate = $request->input('selected_date');
        $selectsubject = $request->input('subjectname');
        $attendanceData = $request->input('students');
        $attendanceJson = [];

        foreach ($attendanceData as $studentId => $data) {
            $status = strtolower($data['attendance'] ?? '');
            $attendanceJson[$studentId] = match ($status) {
                'present' => 1,
                'absent' => 0,
                'leave' => 2,
                default => null,
            };
        }

        // Get class ID from first student
        $firstStudent = Students::find(array_key_first($attendanceJson));
        $classId = $firstStudent->course_year ?? null;

        // Prevent duplicate entries
        $existing = StudentsAttedance::where('teacher_id', $teacher->id)
            ->where('class_id', $classId)
            ->where('subject_id', $selectsubject)
            ->where('date', $selectedDate)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'Attendance already taken.'], 409);
        }

        // Save new attendance
        StudentsAttedance::create([
            'class_id' => $classId,
            'teacher_id' => $teacher->id,
            'date' => $selectedDate,
            'subject_id' => $selectsubject,
            'attendance' => json_encode($attendanceJson),
        ]);

        // Mark schedule as completed
        Schedule::where('teacher_id', $teacher->id)
            ->where('class_name', $classId)
            ->where('subject', $selectsubject)
            ->update(['is_class_taken' => 1]);

        // return response()->json(['message' => 'Attendance submitted successfully.']);
        return redirect()->route('teacher-details',['id' => $user->id]);
    }

    public function attendace_check()
    {
        $classes = Myclass::all();
        $subjects = Subject::all();
        return view('students.student_attendace', compact('classes', 'subjects'));
    }

    public function getSubjects($yearId)
    {
        return Subject::where('year_course', $yearId)
            ->get(['id', 'subjectname']);
    }

    public function getStudents(Request $request)
    {
        $yearId = $request->query('year_id');
        return Students::where('course_year', $yearId)
            ->get(['id', 'full_name']);
    }

    public function getAttendance(Request $request)
    {
        $classId = $request->query('year_id');
        $studentId = $request->query('student_id');
        $subjectId = $request->query('subject_id');

        $attendanceRecords = StudentsAttedance::where('class_id', $classId)
            ->when($subjectId, fn($q) => $q->where('subject_id', $subjectId))
            ->get();

        $results = [];

        foreach ($attendanceRecords as $record) {
            $decoded = json_decode($record->attendance, true);

            if (isset($decoded[$studentId])) {
                $student = Students::find($studentId);
                if (!$student) continue;

                $statusCode = $decoded[$studentId];
                $status = match ($statusCode) {
                    1 => 'Present',
                    0 => 'Absent',
                    2 => 'Leave',
                    default => 'Unknown',
                };

                $results[] = [
                    'name' => $student->full_name,
                    'date' => $record->date,
                    'status' => $status,
                ];
            }
        }

        return response()->json($results);
    }
 public function viewAttendance($teacher_id, $schedule_id)
{
    $schedule = Schedule::findOrFail($schedule_id);

    $attendanceList = StudentsAttedance::where('teacher_id', $teacher_id)
        ->where('class_id', $schedule->class_name)
        ->where('subject_id', $schedule->subject)
        ->where('date', $schedule->date)
        ->get();

    return view('teachers.shedulewise_attenace', compact('attendanceList', 'schedule'));
}

}
