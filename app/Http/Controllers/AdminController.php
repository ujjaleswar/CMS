<?php

namespace App\Http\Controllers;


use App\Models\Myclass;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherRegisteredMail;

class AdminController extends Controller
{
    public function subjects(){
        $classes=Myclass::all();
        return view('admin.subjects',compact('classes'));
    }

    public function StoreSubject(Request $request){
        $subjects=new Subject();
        $subjects->subjectname=$request->subject_name;
        $subjects->subjectcode=$request->subject_code;
        $subjects->year_course=$request->applied_year;
        $subjects->description=$request->description;
        $subjects->save();
        return redirect()->route('subjects-index');
        // dd($subjects);
    }
    public function subindex(){
        $subjects=Subject::all();
        return view('admin.index',compact('subjects'));
    }

    public function edit($id){
         $classes=Myclass::all();
        $subjects=Subject::where('id',$id)->first();
        return view('admin.edit',compact('subjects','classes'));

    }
    public function update(Request $request,$id){
        $subjects=Subject::find($id);
        $subjects->subjectname=$request->subject_name;
        $subjects->subjectcode=$request->subject_code;
        $subjects->year_course=$request->applied_year;
        $subjects->description=$request->description;
        $subjects->save();
        return redirect()->route('subjects-index');
    }


    public function sub_destroy($id)
{
    $class = Subject::findOrFail($id);
    $class->delete();

    return redirect()->route('subjects-index')->with('success', 'subject deleted successfully.');
}

    public function create_teacher(){
         $roles = Role::all();
        $subjects=Subject::all();
        return view('teachers.create',compact('subjects','roles'));
    }

//     public function Store_teacher(Request $request)
// {

//     $user = new User();
//     $user->name = $request->name;
//     $user->email = $request->email;
//     $user->password = Hash::make('1234');
//     $user->role = $request->role;
//     $user->save();

//     $role = Role::find($request->role);
//     if ($role && !$user->hasRole($role->name)) {
//         $user->assignRole($role->name);
//     }


//     $teacher = new Teacher();
//     $teacher->userID = $user->id;
//     $teacher->name = $request->name;
//     $teacher->email = $request->email;
//     $teacher->phone = $request->phone;

//     $selectedSubjects = $request->input('teacherSubject', []);
//     $teacher->preferred_sub = implode(',', $selectedSubjects);
//     $teacher->save();

//     return redirect()->route('teachers-index');
// }

public function Store_teacher(Request $request)
{
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make('1234');
    $user->role = $request->role;
    $user->save();

    $role = Role::find($request->role);
    if ($role && !$user->hasRole($role->name)) {
        $user->assignRole($role->name);
    }

    $teacher = new Teacher();
    $teacher->userID = $user->id;
    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->phone = $request->phone;

    $selectedSubjects = $request->input('teacherSubject', []);
    $teacher->preferred_sub = implode(',', $selectedSubjects);
    $teacher->save();


    Mail::to($teacher->email)->send(new TeacherRegisteredMail($teacher));

    return redirect()->route('teachers-index')->with('success', 'Teacher registered and email sent successfully.');
}
    public function teacher_index(){
        $teachers=Teacher::all();
        return view('teachers.index',compact('teachers'));
    }
public function teachers_edit($id)
{
    $subjects = Subject::all();
    $teachers = Teacher::where('id', $id)->first();

    $teacherSubjects = explode(',', $teachers->preferred_sub);

    return view('teachers.edit', compact('teachers', 'subjects', 'teacherSubjects'));
}
public function teachers_update(Request $request, $id)
{

    $teacher = Teacher::findOrFail($id);

    $teacher->name = $request->name;
    $teacher->email = $request->email;
    $teacher->phone = $request->phone;

    $selectedSubjects = $request->input('teacherSubject', []);
    $teacher->preferred_sub = implode(',', $selectedSubjects);

    $teacher->save();
// dd($teacher);
     return redirect()->route('teachers-index');

}

 public function teacher_destroy($id)
{
    $class = Teacher::findOrFail($id);
    $class->delete();

    return redirect()->route('teachers-index')->with('success', 'teacher deleted successfully.');
}

// public function dashboard()
// {
//     // Example dummy data, replace with actual DB queries
//     $totalStudents = \App\Models\Student::count();
//     $approvedStudents = \App\Models\Student::where('status', 'approved')->count();
//     $rejectedStudents = \App\Models\Student::where('status', 'rejected')->count();
//     $totalTeachers = \App\Models\Teacher::count();
//     $totalSubjects = \App\Models\Subject::count();
//     $totalSchedules = \App\Models\Schedule::count();

//     // Chart data - last 6 months student applications count example
//     $chartLabels = [];
//     $chartData = [];
//     for ($i = 5; $i >= 0; $i--) {
//         $month = now()->subMonths($i);
//         $chartLabels[] = $month->format('M');
//         $chartData[] = \App\Models\Student::whereYear('created_at', $month->year)
//                                          ->whereMonth('created_at', $month->month)
//                                          ->count();
//     }

//     return view('admin.dashboard', compact(
//         'totalStudents', 'approvedStudents', 'rejectedStudents', 'totalTeachers',
//         'totalSubjects', 'totalSchedules', 'chartLabels', 'chartData'
//     ));
// }

 public function create_class(){
    return view('class.create');
 }
public function store_class(Request $request){
   $class= new Myclass();
   $class->class=$request->class;
//    dd($class);
   $class->save();
   return redirect()->route('class-listing');
 }
 public function listing_class(){

    $classes=Myclass::all();
    return view('class.index',compact('classes'));


 }
 // Show Edit Form
public function class_edit($id)
{
    $class = Myclass::findOrFail($id);
    return view('class.edit', compact('class'));
}

// Update Class
public function class_update(Request $request, $id)
{
    $request->validate([
        'class' => 'required|string|max:255',
    ]);

    $class = Myclass::findOrFail($id);
    $class->class = $request->class;
    $class->save();

    return redirect()->route('class-listing')->with('success', 'Class updated successfully.');
}

// Delete Class
public function destroy($id)
{
    $class = Myclass::findOrFail($id);
    $class->delete();

    return redirect()->route('class-listing')->with('success', 'Class deleted successfully.');
}

public function teachersdash(){
  return view('dashboard.teacherdashboard');
}
public function studentsdash(){
  return view('dashboard.studentdashboard');
}


}
