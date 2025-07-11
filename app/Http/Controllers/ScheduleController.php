<?php

namespace App\Http\Controllers;

use App\Models\Myclass;
use App\Models\Schedule;
use App\Models\Students;
use App\Models\StudentsAttedance;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use FontLib\Table\Type\fpgm;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function showAssignSchedule($teacher_id)
    {

    $teacher = Teacher::findOrFail($teacher_id);
    $subjects = Subject::all();

    return view('admin.shedule', compact('teacher', 'subjects'));
    }

    public function showAsignSub($teacher_id)
{
    $teacher = Teacher::findOrFail($teacher_id);
    $classes=Myclass::all();
    $subjects = Subject::all();

    $schedules = Schedule::where('teacher_id', $teacher_id)
        ->orderBy('date', 'desc')
        ->get();

    $scheduleCounts = $schedules->groupBy('date')->map(function ($group) {
        return $group->count();
    });

    $teacherSubjects = [];
    if (!empty($teacher->preferred_sub)) {
        $teacherSubjects = array_map('trim', explode(',', $teacher->preferred_sub));
    }

    return view('admin.asignsub', compact(
        'teacher',
        'subjects',
        'scheduleCounts',
        'teacherSubjects','classes'
    ));
}
public function store(Request $request, $id)
{
    $request->validate([
        'teacherSubject.*' => 'required|integer|exists:subjects,id',
        'class_name.*' => 'required|string',
        'day.*' => 'required|string',
        'date.*' => 'required|date',
        'start_time.*' => 'required',
        'end_time.*' => 'required',
    ]);

    $subjects = $request->teacherSubject;
    $classes = $request->class_name;
    $days = $request->day;
    $dates = $request->date;
    $start_times = $request->start_time;
    $end_times = $request->end_time;
    $schedule_ids = $request->schedule_id ?? [];

    for ($i = 0; $i < count($subjects); $i++) {
        if (!isset($dates[$i]) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dates[$i])) {
            continue;
        }

        $schedule = isset($schedule_ids[$i]) && $schedule_ids[$i]
            ? Schedule::find($schedule_ids[$i]) ?? new Schedule()
            : new Schedule();

        $schedule->teacher_id = $id;
        $schedule->subject = $subjects[$i];
        $schedule->class_name = $classes[$i];
        $schedule->day = $days[$i];
        $schedule->date = $dates[$i];
        $schedule->start_time = $start_times[$i];
        $schedule->end_time = $end_times[$i];

        $schedule->save();
    }

    return redirect()->route('asign', $id)->with('success', 'Schedules stored/updated successfully.');
}




public function view_shedules($teacher_id)
{
    $teacher = Teacher::findOrFail($teacher_id);
    $schedules = Schedule::where('teacher_id', $teacher_id)->orderBy('date', 'desc')->get();

    return view('admin.teacher_schedule', compact('teacher', 'schedules'));
}


// Add this new method to fetch schedules for a specific date
public function getSchedulesByDate($teacher_id, $date)
{
    $schedules = Schedule::with('subjectdtl')
                     ->where('teacher_id', $teacher_id)
                     ->where('date', $date)
                     ->get();
                    // dd($schedules[0]->subjectdtl->subjectname);
                     return response()->json($schedules);

}




// Add delete method
public function destroy($id)
{
    $schedule = Schedule::findOrFail($id);
    $teacher_id = $schedule->teacher_id;
    $schedule->delete();

    return redirect()->route('asign', $teacher_id)->with('success', 'Schedule deleted successfully');
}
public function teachershedule_perdate($teacherId, $date)
{
    $schedules = Schedule::with('subject') // Load related subject data
        ->where('teacher_id', $teacherId)
        ->where('date', $date)
        ->get();

    return response()->json($schedules->map(function ($s) {
        return [
            'subject' => $s->subject ,
            'class_name' => $s->class_name,
            'day' => $s->day,
            'start_time' => $s->start_time,
            'end_time' => $s->end_time,
        ];
    }));
}

// public function teachers_details($id){
    //  $teachers=Teacher::all();
    //   return $teachers;
    //  return view('teachers.teachers_shedule',compact('teachers'));


// }
public function teachers_details($id){



        // $teacher = User::findOrFail($id);

        $teachers = User::where('id', $id)->with('teacher')->first();
// dd($teachers);


        return view('teachers.information', compact('teachers'));



}
// public function teachers_shedulelist()
// {

//      $user = Auth::user();

//     $teacher = Teacher::where('userID', $user->id)->firstOrFail();

//     $subjects = Subject::all();

//     $schedules = Schedule::with('subjectlist')
//         ->where('teacher_id', $teacher->id)
//         ->get();
// // dd($schedules);
//     $scheduleCounts = $schedules->groupBy('date')->map(fn($group) => $group->count());

//     return view('teachers.teacher_shedule', compact(
//         'teacher',
//         'subjects',
//         'scheduleCounts'
//     ));
// }

public function teachers_shedulelist()
{
    $user = Auth::user();
    $teacher = Teacher::where('userID', $user->id)->firstOrFail();

    $subjects = Subject::all();

    $schedules = Schedule::with('subjectlist')
        ->where('teacher_id', $teacher->id)
        ->get();
// dd( $schedules);
    $scheduleCounts = $schedules->groupBy('date')->map(fn($group) => $group->count());
    // dd($attendanceTaken);




    return view('teachers.teacher_shedule', compact(
        'teacher',
        'subjects',
        'schedules',
        'scheduleCounts',
    ));
}

// public function take_attedance(Request $request)
// {
// // dd($request->all());

//     $date = $request->input('selected_date');
//     $subjectname=$request->input('subjectname');
// // dd($subjectname);

//     $students = Students::where('course_year', $request->class_name)->get();
//     // return  $students;

//     return view('teachers.take_attedance', [
//         'students' => $students,
//         'date' => $date,

//     ]);
// }

public function take_attedance(Request $request)
{
    // dd($request->all());
    $date = $request->input('selected_date');
    $subjectname = $request->input('subjectname');
    $className = $request->input('class_name');

    $students = Students::where('course_year', $className)->where('is_status', 1)
    ->orderBy('full_name', 'asc')->get();
    // dd($students);
    return view('teachers.take_attedance', [
        'students' => $students,
        'date' => $date,
        'subjectname' => $request->subjectname,
        'class_name' => $className
    ]);
}



}
